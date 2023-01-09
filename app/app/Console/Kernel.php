<?php

namespace App\Console;

use App\Console\Commands\MonitorMessageBirdBalanceCommand;
use App\Console\Commands\Sync\SyncMessageBirdMessagesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command( SyncMessageBirdMessagesCommand::class )
            ->environments(['production'])
            ->everyFiveMinutes( )
            ->runInBackground();   // allows other command scheduled to be able to run without this thread blocking

        $schedule->command( MonitorMessageBirdBalanceCommand::class )
            ->environments(['production'])
            ->dailyAt( '12:00')
            ->runInBackground();   // allows other command scheduled to be able to run without this thread blocking
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
