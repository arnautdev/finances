<?php

namespace Modules\Store\Entities;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\AttachmentsAwareTrait;
use Modules\Common\Traits\I18nAwareTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProductCategory extends Model implements HasMedia
{
    use AppModelAwareTrait,
        SoftDeletes,
        I18nAwareTrait,
        Translatable,
        HasMediaTrait,
        AttachmentsAwareTrait;

    /**
     * @var string
     */
    public $translationForeignKey = 'productCategoryId';

    /**
     * @var string
     */
    public $translationModel = ProductCategoryI18n::class;

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
    protected $fillable = [
        'parentCategoryId',
        'slug',
        'isActive',
    ];


    /**
     * @var array
     */
    public $attachments = [
        'attachments' => []
    ];


    /**
     * Before create set slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($row) {
            $row->slug = str_slug($row->title);
        });
    }


    /**
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('share-fb')
            ->format('jpg')
            ->fit('fill', 600, 315)
            ->quality(80)
            ->nonQueued();

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
     * Check category is child
     * @return bool|mixed
     */
    public function isChild()
    {
        return ($this->parentCategoryId === 0) ? false : true;
    }

    /**
     * Get all parent categories
     * @return mixed
     */
    public function getAllParentCategories()
    {
        return $this->rows(['isActive' => 'yes', 'parentCategoryId' => 0])->pluck('title', 'id');
    }

    /**
     * Get child categories
     * @return AppModelAwareTrait
     */
    public function getChildCategories($parentCategoryId = null)
    {
        $parentCategoryId = (!is_null($parentCategoryId)) ? $parentCategoryId : $this->id;
        return $this->rows([
            'parentCategoryId' => $parentCategoryId
        ]);
    }

    /**
     * @return array
     */
    public function getSelectedOptions()
    {
        $cout = [];
        $rows = $this->rows(['isActive' => 'yes', 'parentCategoryId' => 0])->pluck('title', 'id');
        foreach ($rows as $categoryId => $title) {
            $childCategories = $this->getChildCategories($categoryId)->pluck('title', 'id');
            if ($childCategories->count() > 0) {
                $cout[$title] = $childCategories;
            } else {
                $cout[$categoryId] = $title;
            }
        }
        return $cout;
    }
}
