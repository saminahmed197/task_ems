<?php

namespace App\Imports;

use App\Models\Holding;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class HoldingsImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //  dd($row['stock_name']);
        return new Holding([
            'user_id'     => '0',
            'stock_symbol'    => strtoupper($row['stock_name']),
            'quantity'      => $row['quantity'],
            'buy_price'         => $row['price'],
            'company_name'  => strtoupper($row['company_name']), // must exist in Excel header
            'is_active'     => 'Y',
            'is_delete'     => 'N',
            'created_by'    => auth()->id(),
            'updated_by'    => auth()->id(),
        ]);
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
