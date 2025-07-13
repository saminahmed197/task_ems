<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holding;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HoldingsImport;
use Illuminate\Support\Str;

class HoldingController extends Controller
{
    //
    public function index(Request $request){
        $query = Holding::with('users')->where('is_active', 'Y');
        $all_clients = User::where('is_admin', 3)
                   ->where('request_decision', 'YES')
                   ->where('is_active', 'Y')
                   ->where('is_delete', 'N')
                   ->get();
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                ->orWhere('stock_symbol', 'like', "%{$search}%")
                ->orWhereHas('users', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        $holdings = $query->latest()->paginate(1);

        if ($request->ajax()) {
            return view('client.holding-client-list-table', compact('holdings', 'all_clients'))->render(); 
        }

        return view('client.holding-list-dashboard', compact('holdings', 'all_clients'));
    }

    public function create(){
       $clients = User::where('is_admin', 3)
                        ->where('request_decision', 'YES')
                        ->where('is_active', 'Y')
                        ->where('is_delete', 'N')
                        ->paginate(1);
        $all_clients = User::select('id', 'name', 'email', 'phone')
                        ->where('is_admin', 3)
                        ->where('request_decision', 'YES')
                        ->where('is_active', 'Y')
                        ->where('is_delete', 'N')
                        ->get();
        //dd($clients);
        return view('client.client-holdings-create', compact('clients', 'all_clients'));
    }

    public function store(Request $request)
    {
        $holding = Holding::create([
            'company_name'   => $request->company_name,
            'user_id' => $request->user_id,
            'stock_symbol'   => $request->stock_symbol,
            'quantity'       => $request->quantity,
            'buy_price'      => $request->buy_price,
            'purchase_date'  => $request->purchase_date,
        ]);
       
        $clientIds = array_merge(
            [$request->user_id],
            $request->additional_user_ids ?? []
        );

        $holding->clients()->sync($clientIds);

        return redirect()->route('admin.clientholdings.list')->with('success', 'Holding added.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'company_name' => 'required|string|max:255',
            'stock_symbol' => 'required|string|max:10',
            'quantity' => 'required|integer|min:1',
            'buy_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            // 'user_ids' => 'required|array',
            // 'user_ids.*' => 'exists:users,id',
        ]);
        $holding = Holding::findOrFail($id);

        $holding->update([
            'company_name' => $request->company_name,
            'stock_symbol' => $request->stock_symbol,
            'quantity' => $request->quantity,
            'buy_price' => $request->buy_price,
            'purchase_date' => $request->purchase_date,
        ]);
        $existingUserIds = $holding->users()->pluck('user_id')->toArray();
        $newUserIds = $request->user_ids;
        $toDeactivate = array_diff($existingUserIds, $newUserIds);
        if (!empty($toDeactivate)) {
            DB::table('client_holding_user')
                ->where('holding_id', $holding->id)
                ->whereIn('user_id', $toDeactivate)
                ->update(['is_active' => 'N']);
        }
        
        foreach ($newUserIds as $userId) {
            DB::table('client_holding_user')->updateOrInsert(
                ['holding_id' => $holding->id, 'user_id' => $userId],
                ['is_active' => 'Y', 'updated_at' => now()]
            );
        }

        return redirect()->route('admin.clientholdings.list')->with('success', 'Holding updated.');
    }

    public function delete($id)
    {
        $holding = Holding::findOrFail($id);
        $holding->is_active = 'N';
        $holding->is_delete = 'Y';
        $holding->updated_by = auth()->id();
        $holding->save();
        $holding->touch();
        return redirect()->route('admin.clientholdings.list')->with('success', 'Holding deleted.');
    }

    public function loadStockuploadform(){
        return view('client.stock-upload');
    }
    public function uploadStocks(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        // dd($request->file('file'));

        try {
            $file = $request->file('file');
            $filename = 'stocks_' . date('Ymd_His') . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/uploads', $filename);
            Excel::import(new HoldingsImport, $file);
            return redirect()->route('admin.loadStockuploadform')->with('success', 'Stocks uploaded successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }
}
