<?php

namespace App\Console;

use App\Jobs\AddGoalActionToTodoListJob;
use App\Jobs\AutoAddMonthlyExpensesJob;
use App\Jobs\MarkGoalAsDoneJob;
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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->job(new AutoAddMonthlyExpensesJob())->monthlyOn(1, '12:05');
        $schedule->job(new AddGoalActionToTodoListJob())->dailyAt('5:00');
        $schedule->job(new MarkGoalAsDoneJob())->everyMinute();


        /// run queue
        $schedule->command('queue:work --tries=3 --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping();
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
