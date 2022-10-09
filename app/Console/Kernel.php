<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Offer\LuckyNumber;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        Commands\LuckyNumberGenerate::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('backup:clean')->daily()->at('22:31');
        // $schedule->command('backup:run')->daily()->at('22:32');
        $schedule->command('luckynumer:generate')->timezone('Asia/Dhaka')->dailyAt('12:10');

        //php artisan luckynumer:generate
        // php artisan schedule:work
        //php artisan schedule:run
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
