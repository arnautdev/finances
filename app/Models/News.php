<?php

namespace App\Models;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\AttachmentsAwareTrait;
use Modules\Common\Traits\I18nAwareTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class News extends Model implements HasMedia
{
    use AppModelAwareTrait,
        Translatable,
        HasMediaTrait,
        SoftDeletes,
        I18nAwareTrait,
        AttachmentsAwareTrait;

    /**
     * @var string
     */
    public $translationModel = NewsI18n::class;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title', 'description', 'content'
    ];

    /**
     * @var array
     */
    public $fillable = [
        'isActive',
        'slug',
        'videoUrl',
        'publishDate'
    ];

    public $attachments = [
        'newsImages' => [

        ]
    ];

    /**
     * Register media conversions
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {

        $this->addMediaConversion('fbShareNewsImage')
            ->format('jpg')
            ->fit('fill', 600, 315)
            ->quality(80)
            ->nonQueued();
        $this->addMediaConversion('newsImages')
            ->format('jpg')
            ->fit('fill', 1024, 400)
            ->quality(80)
            ->nonQueued();
        $this->addMediaConversion('newsImageSmall')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();
    }
}
