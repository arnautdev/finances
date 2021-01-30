<?php

namespace App\Observers;

use App\Models\Goal;
use App\Notifications\MarkGoalAsDoneNotification;

class GoalObserver
{
    /**
     * Handle the goal "created" event.
     *
     * @param \App\Models\Goal $goal
     * @return void
     */
    public function created(Goal $goal)
    {
        //
    }

    /**
     * Handle the goal "updated" event.
     *
     * @param \App\Models\Goal $goal
     * @return void
     */
    public function updated(Goal $goal)
    {
        if ($goal->isDirty('isDone') && $goal->isDone == 'yes') {
            $user = $goal->user()->first();
            if ($user->exists) {
                $user->notify(new MarkGoalAsDoneNotification($goal));
            }
        }
    }

    /**
     * Handle the goal "deleted" event.
     *
     * @param \App\Models\Goal $goal
     * @return void
     */
    public function deleted(Goal $goal)
    {
        //
    }

    /**
     * Handle the goal "restored" event.
     *
     * @param \App\Models\Goal $goal
     * @return void
     */
    public function restored(Goal $goal)
    {
        //
    }

    /**
     * Handle the goal "force deleted" event.
     *
     * @param \App\Models\Goal $goal
     * @return void
     */
    public function forceDeleted(Goal $goal)
    {
        //
    }
}
