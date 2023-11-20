<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CleanupPasswordResetTokens;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run the cleanup task every hour (adjust the schedule as needed)
        $schedule->command('tokens:cleanup')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // Add the CleanupPasswordResetTokens command to the commands array
        // $this->commands([
        //     CleanupPasswordResetTokens::class,
        // ]);

        require base_path('routes/console.php');
    }
}
