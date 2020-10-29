<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyExpenses extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * Set fillable fields
     * @var array
     */
    public $fillable = [
        'userId',
        'expenseId',
        'toDate',
        'amount'
    ];

    /**
     * Get today added expenses
     * @return mixed
     */
    public function getTodayAdded()
    {
        $userId = auth()->id();

        return $this->where('userId', '=', $userId)
            ->where('toDate', '=', date('Y-m-d'))
            ->get();
    }

    /**
     * Get user
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUser()
    {
        return $this->hasOne(User::class, 'userId', 'id')->firstOrFail();
    }

    /**
     * Get expense
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasOne|object|null
     */
    public function getExpense()
    {
        return $this->hasOne(Expenses::class, 'expenseId', 'id')->firstOrFail();
    }
}
