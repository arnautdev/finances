<?php

namespace Modules\Store\Entities;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\AttachmentsAwareTrait;
use Modules\Common\Traits\I18nAwareTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Brands extends Model implements HasMedia
{
    use AppModelAwareTrait,
        HasMediaTrait,
        Translatable,
        I18nAwareTrait,
        AttachmentsAwareTrait;

    /**
     * @var string
     */
    public $translationForeignKey = 'brandId';

    /**
     * @var string
     */
    public $translationModel = BrandsI18n::class;

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
        'isActive'
    ];

    /**
     * @var array
     */
    public $attachments = [
        'attachments' => []
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($entity) {
            $entity->slug = str_slug($entity->title);
        });
    }

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
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
}
