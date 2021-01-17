<?php

namespace App\Jobs;

use App\Models\Goal;
use App\Models\TodoList;
use App\Traits\UserIdFilterScopeAwareTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddGoalActionToTodoListJob implements ShouldQueue
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
        $goals = Goal::withoutGlobalScopes()->where('isDone', '=', 'no')->get();
        $goals->each(function ($goal, $key) {
            $goalAction = $goal->goalAction()->first();
            if ($goalAction->addToTodayTodoList()) {
                $todoTask = [
                    'description' => '[' . $goal->title . ']: ' . $goalAction->title,
                    'userId' => $goal->userId,
                    'goalActionId' => $goalAction->id,
                ];

                TodoList::create($todoTask);
            }
        });
    }
}
