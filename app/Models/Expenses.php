<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * @var array
     */
    public $fillable = [
        'expenseType',
        'userId',
        'title',
        'expenseType',
        'dynamicAmount',
        'amount',
    ];


    /**
     * Check if is dynamic amount
     * @return bool
     */
    public function isDynamicAmount()
    {
        return $this->dynamicAmount === 'yes';
    }


    /**
     * @param int $userId
     * @return int
     */
    public function getStaticExpensesAmount(int $userId): int
    {
        return $this->where('userId', '=', $userId)
            ->where('expenseType', '=', 'monthly')
            ->sum('amount');
    }
}
