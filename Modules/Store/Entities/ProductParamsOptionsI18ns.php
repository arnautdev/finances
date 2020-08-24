<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductParamsOptionsI18ns extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title'
    ];
}
