<?php

namespace App\Http\Controllers;


use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Jobs\BulkClientUpdateJob;

class AdminController extends Controller
{
    // Client Portfolio Management

    // 1. Client approval
    public function clientlistDashboard(Request $request){
        $query = User::where('is_admin', '!=', 1);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $clients = $query->orderBy('id', 'desc')->paginate(2);

        if ($request->ajax()) {
            return view('client.client-list-table', compact('clients'))->render();
        }
        return view('client.user-list-dashboard', compact('clients'));
    }

    public function approveSelectedClients(Request $request){
        $clientIds = $request->input('client_ids', []);
        $roles = $request->input('role', []);
        $statuses = $request->input('status', []);
        if (empty($clientIds)) {
            return back()->with('error', 'No user selected.');
        }

        foreach ($clientIds as $id) {
            $user = User::find($id);
            if ($user) {
                $user->request_decision = 'YES';
                // $user->request_role = $roles[$id] ?? $user->request_role;
                $user->is_admin = $roles[$id] ?? $user->is_admin;
                $user->request_decision_by = auth()->user()->id;
                $user->is_active = $statuses[$id] ?? $user->is_active;
                $user->is_delete = $user->is_active === 'Y' ? 'N' : 'Y'; 
                $user->save();
            }
        }

        // Dispatch the job to the queue for updating data
        // BulkClientUpdateJob::dispatch($clientIds, $roles, $statuses);   

        return back()->with('success', 'User list updated successfully.');
    }


   
}
