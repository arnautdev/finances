<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalAction extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * @var array
     */
    protected $fillable = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goalId', 'id');
    }
}
