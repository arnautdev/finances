<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use App\Traits\UtilsAwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensesSettings extends Model
{
    use HasFactory,
        SoftDeletes,
        UtilsAwareTrait,
        UserIdFilterScopeAwareTrait;

    /**
     * @var array
     */
    public $fillable = [
        'userId',
        'categoryId',
        'title',
        'expenseType',
        'dynamicAmount',
        'amount',
        'isAutoAdd'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * @return mixed
     */
    public function getStaticMonthlyExpenses()
    {
        return $this->where('isAutoAdd', '=', 'yes')->get();
    }

    /**
     * Get expenses list
     * @return mixed
     */
    public function getExpensesList()
    {
        return $this->whereIn('expenseType', ['static', 'dynamic'])->where('isAutoAdd', '!=', 'yes')->get();
    }

    /**
     * Get user
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser()
    {
        return $this->belongsTo(User::class, 'userId', 'id')->firstOrFail();
    }

    /**
     * Get category
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function getCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'categoryId', 'id')->first();
    }

    /**
     * Check if is dynamic amount
     * @return bool
     */
    public function isDynamicAmount()
    {
        return $this->amount == 0;
    }


    /**
     * @param int $userId
     * @return int
     */
    public function getStaticExpensesAmount(): int
    {
        return $this->where('expenseType', '=', 'monthly')->sum('amount');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'categoryId', 'id');
    }
}
