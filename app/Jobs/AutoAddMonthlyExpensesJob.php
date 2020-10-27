<?php

namespace App\Jobs;

use App\Models\Expenses;
use App\Models\User;
use App\Notifications\ExpensesIsAddedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoAddMonthlyExpensesJob // implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $expenses = $user->getExpenses()
                ->where('userId', '=', $user->id)
                ->where('isAutoAdd', '=', 'yes')
                ->get();

            if ($expenses->count() > 0) {
                $user->notify(new ExpensesIsAddedNotification($expenses));
            }
        }
    }
}
