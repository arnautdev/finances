<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class SeoOptimizationI18n extends Model
{
    /**
     * Disable timestamp
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
