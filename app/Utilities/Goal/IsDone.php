<?php


namespace App\Utilities\Goal;


use App\Utilities\FilterContract;

class IsDone implements FilterContract
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
        if ($value != 'all') {
            $this->query->where('isDone', '=', $value);
        }
    }
}
