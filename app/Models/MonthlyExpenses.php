<?php

namespace App\Models;

use App\Scopes\UserIdFilterScope;
use App\Traits\UserIdFilterScopeAwareTrait;
use App\Traits\UtilsAwareTrait;
use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyExpenses extends Model
{
    use HasFactory,
        SoftDeletes,
        UserIdFilterScopeAwareTrait,
        UtilsAwareTrait;


    /**
     * Set fillable fields
     * @var array
     */
    public $fillable = [
        'userId',
        'expenseId',
        'categoryId',
        'toDate',
        'amount'
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($row) {
            $row->toDate = date('Y-m-d');
        });
    }

    /**
     * @param $query
     * @param $filters
     */
    public function scopeFilterBy($query, $filters)
    {
        $today = new \DateTime();
        $startMonth = $today->modify('first day of this month')->format('Y-m-d');
        $endMonth = $today->modify('last day of this month')->format('Y-m-d');

        if (!isset($filters['toDate'])) {
            $filters['toDate'] = $startMonth . ' - ' . $endMonth;
        }

        $namespace = basename(self::class);
        $namespace = str_replace('Models', 'Utilities', $namespace);
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->intToFloat($this->amount);
    }

    /**
     * Calculate average per day
     */
    public function getAveragePerDay()
    {
        $startUseSystem = (new SystemSettings())->getSettingsKey('startUseDate');
        $dateDiff = date_diff(new \DateTime($startUseSystem), new \DateTime());

        $spentAmount = intval($this->sum('amount'));

        if ($spentAmount == 0 || $dateDiff->days == 0) {
            return 0;
        }

        $averagePerDay = number_format(($spentAmount / ($dateDiff->days * 100)), 2);

        return $averagePerDay;
    }

    /**
     * Get today added expenses
     * @return mixed
     */
    public function getTodayAdded()
    {
        return $this->where('toDate', '=', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * Get category
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'categoryId', 'id')->firstOrFail();
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
        return $this->belongsTo(Expenses::class, 'expenseId', 'id')->firstOrFail();
    }
}
