<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory, SoftDeletes, UserIdFilterScopeAwareTrait;

    /**
     * @var string[]
     */
    public $fillable = [
        'title',
        'userId',
    ];


    /**
     * @param int $userId
     * @return array
     */
    public function getSelectedOptions(): object
    {
        return $this->get()->pluck('title', 'id');
    }


    /**
     * Get monthly expenses
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMonthlyExpenses($request = null)
    {
        if (!is_null($request)) {
            return $this->hasMany(MonthlyExpenses::class, 'categoryId', 'id')
                ->filterBy($request->all())
                ->orderBy('id', 'DESC')
                ->get();
        }

        return $this->hasMany(MonthlyExpenses::class, 'categoryId', 'id')
            ->orderBy('id', 'DESC')
            ->get();
    }
}
