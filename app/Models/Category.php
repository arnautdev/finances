<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'userId',
    ];

    /**
     * @param $filters
     * @param $query
     */
    public function scopeFilterBy($query, $filters)
    {
        return $query->orderBy('id', 'DESC');
    }

}
