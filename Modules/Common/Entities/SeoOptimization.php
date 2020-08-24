<?php

namespace Modules\Common\Entities;

use App\Traits\AppModelAwareTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\AttachmentsAwareTrait;
use Modules\Common\Traits\I18nAwareTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class SeoOptimization extends Model implements HasMedia
{
    use AppModelAwareTrait,
        SoftDeletes,
        HasMediaTrait,
        Translatable,
        AttachmentsAwareTrait,
        I18nAwareTrait;

    /**
     * @var string
     */
    public $translationForeignKey = 'seoOptimizationId';

    /**
     * @var string
     */
    public $translationModel = SeoOptimizationI18n::class;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'itemId',
        'model',
    ];

    /**
     * @var array
     */
    public $attachments = [
        'ogImage' => [
            'clearBeforeSave' => true
        ]
    ];

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('fb-share')
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
            ->fit('fill', 600, 600)
            ->quality(80)
            ->nonQueued();


        $this->addMediaConversion('lg')
            ->format('jpg')
            ->fit('fill', 1024, 1024)
            ->quality(80)
            ->nonQueued();
    }
}
