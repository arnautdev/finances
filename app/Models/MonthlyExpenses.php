<?php

namespace App\Models;

use App\Scopes\UserIdFilterScope;
use App\Traits\UserIdFilterScopeAwareTrait;
use App\Traits\UtilsAwareTrait;
use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        'title',
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
            $row->amount = $row->floatToInt($row->amount);
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

        $amount = DB::table('monthly_expenses')
            ->join('expenses_settings', function ($join) {
                $join->on('monthly_expenses.expenseId', '=', 'expenses_settings.id')
                    ->where('expenses_settings.isAutoAdd', '=', 'no');
            })
            ->where('monthly_expenses.userId', '=', auth()->id())
            ->sum('monthly_expenses.amount');
        $spentAmount = intval($amount);

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
        $expense = $this->belongsTo(ExpensesSettings::class, 'expenseId', 'id')->firstOrNew();
        if (!$expense->exists) {
            $expense->title = $this->title;
            $expense->categoryId = $this->categoryId;
        }

        return $expense;
    }
}
