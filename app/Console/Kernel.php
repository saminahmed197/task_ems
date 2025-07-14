<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendMail::class,
        \App\Console\Commands\UpdateStockPrices::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule){
        $schedule->command('mail:send-greeting')->everyMinute();//dailyAt('07:00'); //everyMinute();
        $schedule->command('stocks:update-prices')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    

}
