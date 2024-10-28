<?php

namespace App\Console;

use App\Console\Commands\SendPostNotifications;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;







class Kernel extends ConsoleKernel
{
    protected $commands = [
       SendPostNotifications::class, // Register your command here
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();
        // Run the command every hour (adjust timing as needed)
        $schedule->command('send:post-notifications')->hourly();
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
