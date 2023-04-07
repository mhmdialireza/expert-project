<?php

namespace App\Console;

use App\Models\Todo;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $notificationService = new NotificationService();
            $now = Carbon::now();
            $now->second = 0;

            $tasks = Todo::where('reminder_datetime', $now)->get();
            foreach ($tasks as $task) {
                $notificationService->send($task);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
