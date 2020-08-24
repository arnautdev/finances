<?php

namespace Modules\Store\Entities;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\I18nAwareTrait;

class ProductParamsOptions extends Model
{
    use AppModelAwareTrait,
        SoftDeletes,
        I18nAwareTrait,
        Translatable;

    /**
     * @var string
     */
    public $translationForeignKey = 'productParamsOptionId';

    /**
     * @var string
     */
    public $translationModel = ProductParamsOptionsI18ns::class;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title'
    ];


    /**
     * @var array
     */
    protected $fillable = [
        'productParamId',
        'optionKey'
    ];
}
