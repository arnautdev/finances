<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryI18n extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'content',
    ];
}
