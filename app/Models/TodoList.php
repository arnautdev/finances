<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoList extends Model
{
    use HasFactory, SoftDeletes, UserIdFilterScopeAwareTrait;

    /**
     * @var string[]
     */
    public $fillable = [
        'userId',
        'description',
        'isDone'
    ];

    /**
     * @param $query
     * @param $filters
     * @return mixed
     * @throws \Exception
     */
    public function scopeFilterBy($query, $filters)
    {
        $today = new \DateTime();
        $startMonth = $today->modify('first day of this month')->format('Y-m-d');
        $endMonth = $today->modify('last day of this month')->format('Y-m-d');

        if (!isset($filters['created_at'])) {
            $filters['created_at'] = $startMonth . ' - ' . $endMonth;
        }

        $namespace = basename(self::class);
        $namespace = str_replace('Models', 'Utilities', $namespace);
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

    /**
     * Get todo list for today
     * @return mixed
     */
    public function getTodoList()
    {
        return $this->where('toDate', 'LIKE', date('Y-m-d') . '%')
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * @return bool
     */
    public function isDone()
    {
        return ($this->isDone == 'yes');
    }

}
