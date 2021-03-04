<?php


namespace App\Utilities;


use App\Models\MonthlyExpenses;
use App\Traits\UtilsAwareTrait;

class YearlyDataAggregator
{

    use UtilsAwareTrait;

    /**
     * @var array
     */
    public $months = [];

    /**
     * @var
     */
    private $sumStaticExpenses = 0;

    /**
     * @var int
     */
    private $sumAddedExpenses = 0;

    /**
     * YearlyDataAggregator constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize service
     */
    private function init()
    {
        $this->setMonths();
    }

    /**
     *
     */
    public function getAddedExpensesForCurrentYear()
    {
        $expenses = $this->getStaticMonthlyExpenses();
        $out = [];
        if ($expenses->count() > 0) {
            foreach ($expenses as $expens) {
                foreach ($this->months as $month) {
                    $month = $this->getSqlDate($month)->format('Y-m-');
                    $monthlyExpense = MonthlyExpenses::where('toDate', 'LIKE', $month . '%')
                        ->where('expenseId', '=', $expens->id)
                        ->firstOrNew();

                    $out[$expens->title][$month] = $monthlyExpense;
                }
            }
        }
        return collect($out);
    }

    /**
     * @return float
     */
    public function getSumStaticExpenses()
    {
        return $this->intToFloat($this->sumStaticExpenses);
    }


    /**
     * @return float
     */
    public function getSumAddedExpenses()
    {
        return $this->intToFloat($this->sumAddedExpenses);
    }

    /**
     * @param object $expense
     * @return float
     */
    public function getTotalAmount($expense)
    {
        $amount = 0;
        if ($expense instanceof Expenses) {
            $amount = ($expense->amount * 12);
            $this->sumStaticExpenses += $amount;
        }

        if (is_array($expense)) {
            $amount = collect($expense)->sum('amount');
            $this->sumAddedExpenses += $amount;
        }

        return $this->intToFloat($amount);
    }

    /**
     * @return mixed
     */
    public function getStaticMonthlyExpenses()
    {
        return (new Expenses())->getStaticMonthlyExpenses();
    }

    /**
     * Set months
     */
    private function setMonths()
    {
        $monthsLabels = $this->createLabels([
            'step' => '+1 month',
            'from' => date('Y-01-01'),
            'to' => date('Y-12-31'),
        ]);

        $this->months = $monthsLabels;
    }

}
