<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:expire-test-iptv-subscription')->everyMinute();
        $schedule->command('app:expire-subscription')->everyMinute();
        $schedule->command('app:send-inactive-reminders')->everyMinute();
        $schedule->command('app:send-subscription-expiration-reminders')->everyMinute();
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
