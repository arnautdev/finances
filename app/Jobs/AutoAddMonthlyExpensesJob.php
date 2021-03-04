<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ExpensesIsAddedNotification;
use App\Traits\UtilsAwareTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AutoAddMonthlyExpensesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, UtilsAwareTrait;

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
                ->withoutGlobalScopes() /// disable global scopes
                ->where('userId', '=', $user->id)
                ->where('isAutoAdd', '=', 'yes')
                ->get();

            if ($expenses->count() > 0) {

                $createMany = $expenses->map(function ($row) {
                    return [
                        'userId' => $row->userId,
                        'categoryId' => $row->categoryId,
                        'expenseId' => $row->id,
                        'amount' => $this->intToFloat($row->amount),
                    ];
                });

                if ($user->getMonthlyExpenses()->createMany($createMany)) {
                    $user->notify(new ExpensesIsAddedNotification($expenses));
                }
                Log::error(__METHOD__ . ' Error add expenses for user: ' . $user->id);
            }
        }
    }
}
