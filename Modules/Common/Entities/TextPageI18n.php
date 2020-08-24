<?php

namespace Modules\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class TextPageI18n extends Model
{
    /**
     * Disable timestamps
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set fillable fields
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'content'
    ];
}
