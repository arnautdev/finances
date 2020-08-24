<?php

namespace Modules\Store\Entities;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\I18nAwareTrait;

class ProductParams extends Model
{
    use AppModelAwareTrait,
        SoftDeletes,
        Translatable,
        I18nAwareTrait;
    /**
     * @var string
     */
    public $translationForeignKey = 'productParamId';

    /**
     * @var string
     */
    public $translationModel = ProductParamsI18n::class;

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
        'isActive',
        'productId',
        'options',
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($entity) {
            $entity->options = implode(',', $entity->options);
        });

        static::saved(function ($entity) {
            $out = [];
            foreach ($entity->getExplodeOptionsArray() as $key => $option) {
                $optionKey = str_slug($option);
                $out[$optionKey]['optionKey'] = $optionKey;
                $out[$optionKey]['title'] = $option;
            }

            /// create options
            $entity->getOptions()->delete();
            $entity->getOptions()->createMany($out);
        });
    }

    /**
     * Get product param options
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getOptions()
    {
        return $this->hasMany(ProductParamsOptions::class, 'productParamId', 'id');
    }

    /**
     * @return array
     */
    public function getExplodeOptionsArray()
    {
        return explode(',', $this->options);
    }
}
