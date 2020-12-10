<?php


namespace App\Utilities\TodoList;


use App\Utilities\FilterContract;

class Created_at implements FilterContract
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

        $this->query->where('created_at', '>=', $dates[0])
            ->where('created_at', '<=', $dates[1])
            ->orWhere('created_at', 'LIKE', $dates[0] . '%')
            ->orWhere('created_at', 'LIKE', $dates[1] . '%');
    }
}
