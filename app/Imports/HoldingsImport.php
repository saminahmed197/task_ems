<?php

namespace App\Imports;

use App\Models\Holding;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class HoldingsImport implements OnEachRow, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $row = $row->toCollection();
        $stockSymbol = strtoupper($row['stock_name']);  //dd($stockSymbol);
   
        $unownedHolding = Holding::where('stock_symbol', $stockSymbol)
        ->where('is_active', 'Y')
        ->whereDoesntHave('users')  
        ->first();
        // dd($unownedHolding);
        if ($unownedHolding) {
            $unownedHolding->quantity += $row['quantity'];
            $unownedHolding->buy_price += $row['price'];
            $unownedHolding->updated_by = auth()->id();
            $unownedHolding->save();
        } else {
            Holding::create([
                'user_id'       => 0,
                'stock_symbol'  => $stockSymbol,
                'quantity'      => $row['quantity'],
                'buy_price'     => $row['price'],
                'company_name'  => strtoupper($row['company_name']),
                'sector' => strtoupper($row['sector']),
                'is_active'     => 'Y',
                'is_delete'     => 'N',
                'created_by'    => auth()->id(),
                'updated_by'    => auth()->id(),
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 100; 
    }

    public function batchSize(): int
    {
        return 100;
    }
}
