<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquitySummaryExport implements FromView
{
    protected $holdings;

    public function __construct($holdings)
    {
        $this->holdings = $holdings;
    }

    public function view(): View
    {
        return view('reports.equity-summary-excel', [
            'holdings' => $this->holdings
        ]);
    }
}

