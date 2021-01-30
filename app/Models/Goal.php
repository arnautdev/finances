<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use App\Traits\UtilsAwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;

class Goal extends Model
{
    use HasFactory, UserIdFilterScopeAwareTrait, SoftDeletes, UtilsAwareTrait;

    /**
     * @var string[]
     */
    public $fillable = [
        'title',
        'userId',
        'startDate',
        'endDate',
        'isDone',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * @return object
     */
    public function goalAction(): object
    {
        return $this->hasOne(GoalAction::class, 'goalId', 'id');
    }

    /**
     * Check exists goal action
     * @return bool
     */
    public function existsGoalAction(): bool
    {
        $goalAction = $this->goalAction()->firstOrNew([], []);
        return $goalAction->exists;
    }


    /**
     * Get goal progress percent
     * @return number
     */
    public function getGoalProgressPercent(): float
    {
        $dateLabels = $this->createLabels([
            'from' => $this->startDate,
            'to' => $this->endDate
        ], 'l');
        $dateLabels = array_count_values($dateLabels);

        $goalAction = $this->goalAction()->first();
        $goalActionWeekDays = $goalAction->getWeekDaysNames();

        $totalGoalActionCount = 0;
        foreach ($goalActionWeekDays as $goalActionWeekDay) {
            if (isset($dateLabels[$goalActionWeekDay])) {
                $totalGoalActionCount += $dateLabels[$goalActionWeekDay];
            }
        }

        $addedGoalActionsCount = $this->getAddedGoalActionsCount($goalAction);


        $discount = 0;
        if ($addedGoalActionsCount > 0 && $totalGoalActionCount > 0) {
            $percent = ($addedGoalActionsCount / $totalGoalActionCount);
            $discount = ($percent * 100);
        }
        return number_format($discount, 2);
    }

    /**
     * @param GoalAction $goalAction
     * @return number
     */
    private function getAddedGoalActionsCount(GoalAction $goalAction): int
    {
        return TodoList::withoutGlobalScopes()
            ->where('isDone', '=', 'yes')
            ->where('goalActionId', '=', $goalAction->id)
            ->count();
    }
}
