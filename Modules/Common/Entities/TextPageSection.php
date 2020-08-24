<?php

namespace Modules\Common\Entities;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class TextPageSection extends Model implements HasMedia
{
    use AppModelAwareTrait, SoftDeletes, HasMediaTrait, Translatable;

    /**
     * Set translation foreign key
     * @var string
     */
    public $translationForeignKey = 'pageSectionId';

    /**
     * Set translation model
     * @var string
     */
    public $translationModel = TextPageSectionI18n::class;

    /**
     * Set translation attributes
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'description',
        'content'
    ];

    /**
     * Set fillable fields
     * @var array
     */
    protected $fillable = [
        'pageId',
        'ord',
        'slug',
        'isActive',
    ];

    /**
     * Add page media
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('fbShareImage')
            ->format('jpg')
            ->fit('fill', 600, 315)
            ->quality(80)
            ->nonQueued();
        $this->addMediaConversion('fbShareImageSmall')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();


        $this->addMediaConversion('pageImage')
            ->format('jpg')
            ->fit('fill', 1024, 1024)
            ->quality(80)
            ->nonQueued();
        $this->addMediaConversion('pageImageSmall')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();


        $this->addMediaConversion('pageGallery')
            ->format('jpg')
            ->fit('fill', 1024, 1024)
            ->quality(80)
            ->nonQueued();
        $this->addMediaConversion('pageGallerySmall')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();
    }
}
