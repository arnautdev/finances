<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use HasFactory, UserIdFilterScopeAwareTrait, SoftDeletes;

    public $fillable = [
        'title',
        'userId',
        'startDate',
        'endDate',
    ];

    /**
     * @return object
     */
    public function goalAction(): object
    {
        return $this->hasOne(GoalAction::class, 'goalId', 'id');
    }
}
