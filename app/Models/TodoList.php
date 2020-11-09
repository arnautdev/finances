<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
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
