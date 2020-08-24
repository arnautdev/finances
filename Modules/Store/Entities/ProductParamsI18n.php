<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductParamsI18n extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['title'];
}
