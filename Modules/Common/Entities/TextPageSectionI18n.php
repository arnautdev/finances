<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class TextPageSectionI18n extends Model
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
        'content'
    ];
}
