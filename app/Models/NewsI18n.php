<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsI18n extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $fillable = [
        'title',
        'description',
        'content'
    ];
}
