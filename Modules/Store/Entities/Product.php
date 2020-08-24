<?php

namespace Modules\Store\Entities;

use App\Traits\AppModelAwareTrait;
use App\Traits\UtilsTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\AttachmentsAwareTrait;
use Modules\Common\Traits\I18nAwareTrait;
use Modules\Common\Traits\SeoAwareTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Product extends Model implements HasMedia
{
    use AppModelAwareTrait,
        HasMediaTrait,
        SoftDeletes,
        UtilsTrait,
        Translatable,
        I18nAwareTrait,
        AttachmentsAwareTrait,
        SeoAwareTrait;

    /**
     * Set fillable fields
     * @var array
     */
    protected $fillable = [
        'status',
        'isActive',
        'inPromo',
        'isNew',
        'price',
        'promoPrice',
        'gettingPrice',
        'slug',
        'categoryId',
        'addedByUserId',
        'catalogNumber',
        'brandId',
    ];


    /**
     * @var string
     */
    public $translationForeignKey = 'productId';

    /**
     * @var string
     */
    public $translationModel = ProductI18n::class;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'description',
        'content',
    ];

    /**
     * @var array
     */
    public $attachments = [
        'attachments' => [],
        'ogImage' => [
            'clearBeforeSave' => true
        ],
    ];

    /**
     * Register media conversions
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('sm')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();

        $this->addMediaConversion('md')
            ->format('jpg')
            ->fit('fill', 600, 315)
            ->quality(80)
            ->nonQueued();


        $this->addMediaConversion('lg')
            ->format('jpg')
            ->fit('fill', 1024, 1024)
            ->quality(80)
            ->nonQueued();
    }

    /**
     * Get product price
     * @return mixed
     */
    public function getPrice()
    {
        if ($this->inPromo()) {
            return $this->promoPrice;
        }
        return $this->price;
    }

    /**
     * @return bool
     */
    public function inPromo()
    {
        if ($this->inPromo == 'yes') {
            return true;
        }
        return false;
    }


    /**
     * Get main category
     * @return Model|static
     */
    public function getMainCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'categoryId', 'id')->firstOrNew([], []);
    }

    /**
     * Get all rels-categories
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getCategories()
    {
        return $this->hasMany(ProductCategoryRel::class, 'productId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getRelatedProducts()
    {
        return $this->hasMany(RelatedProducts::class, 'productId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProductParams()
    {
        return $this->hasMany(ProductParams::class, 'productId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProductOptions()
    {
        return $this->hasMany(ProductOptions::class, 'productId', 'id');
    }

    /**
     * @return array|false
     */
    public function generateProductOptions()
    {
        $rows = $this->getProductParams()->get();

        $options = [];
        $rows->map(function ($row) use (&$options) {
            $options[] = collect($row->getExplodeOptionsArray());
        });

        $keys = collect($this->combinations($options, true))->map(function ($row) {
            return implode(':', $row);
        })->toArray();
        $values = $this->combinations($options);

        $generatedCombinations = collect(array_combine($keys, $values))->map(function ($row, $optionKey) {
            return new ProductOptions([
                'optionKey' => $optionKey,
                'optionLabel' => implode(',', $row)
            ]);
        });

        $existsCombinations = $this->getProductOptions()->get();

        return $generatedCombinations->merge($existsCombinations)->keyBy('optionKey');
    }

    /**
     * @param $arrays
     * @return array
     */
    public function combinations($arrays, $keys = false)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $property_value = ($keys) ? strtolower(str_slug($property_value)) : $property_value;

                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

}
