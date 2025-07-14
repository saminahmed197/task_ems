<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Holding;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class UpdateStockPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:update-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch updated stock prices and update holdings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $response = Http::get('http://127.0.0.1:8001/api/mock-stocks');

        if (!$response->successful()) {
            $this->error('API call failed');
            return;
        }

        $allPrices = collect($response->json());

        $holdings = Holding::where('is_active', 'Y')->get();

        foreach ($holdings as $holding) {
            $match = $allPrices->firstWhere('stock_name', strtoupper($holding->stock_symbol));

            if ($match) {
                $holding->current_price = $match['price'];
                $holding->last_price_updated_at = Carbon::now();
                $holding->save();
            }
        }

        $this->info('Stock prices updated successfully.');
    }
}
