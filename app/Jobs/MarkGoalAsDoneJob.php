<?php

namespace App\Jobs;

use App\Models\Goal;
use App\Models\TodoList;
use App\Traits\UtilsAwareTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkGoalAsDoneJob implements ShouldQueue
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
        $goals = Goal::withoutGlobalScopes()->where('isDone', '=', 'no')->get();
        $goals->each(function ($goal, $key) {
            $progressPercent = $this->floatToInt($goal->getGoalProgressPercent());
            if ($progressPercent == 10000 || $progressPercent == 100) {
                $goal->update(['isDone' => 'yes']);
            }
        });
    }
}
