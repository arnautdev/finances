<?php


namespace App\Utilities\MonthlyExpenses;


use App\Utilities\FilterContract;

class ToDate implements FilterContract
{

    /**
     * @var
     */
    protected $query;

    /**
     * ToDate constructor.
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @param $value
     */
    public function handle($value): void
    {
        $dates = explode(' - ', $value);

        $this->query->where('toDate', '>=', $dates[0])->where('toDate', '<=', $dates[1]);
    }
}
