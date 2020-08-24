<?php

namespace Modules\Common\Entities;

use App\Traits\AppModelAwareTrait;
use App\Traits\UtilsTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\Traits\AttachmentsAwareTrait;
use Modules\Common\Traits\I18nAwareTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class TextPage extends Model implements HasMedia
{
    use AppModelAwareTrait,
        HasMediaTrait,
        AttachmentsAwareTrait,
        I18nAwareTrait,
        SoftDeletes,
        Translatable,
        UtilsTrait;

    /**
     * Set translation foreign key
     * @var string
     */
    public $translationForeignKey = 'pageId';

    /**
     * Set translation model
     * @var string
     */
    public $translationModel = TextPageI18n::class;

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
     * @var array
     */
    protected $fillable = [
        'slug',
        'isActive',
    ];

    /**
     * Set all attachments
     * @var array
     */
    public $attachments = [
        'fbShareImage' => [
            'clearBeforeSave' => true,
        ],
        'pageImage' => [
            'clearBeforeSave' => true,
        ],
        'pageGallery' => [
            'limit' => 10
        ],
    ];


    /**
     * Get text page sections
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function sections($args = null)
    {
        if (isset($args['order'])) {
            return $this->hasMany(TextPageSection::class, 'pageId', 'id')
                ->orderBy($args['order'][0], $args['order'][1])
                ->get();
        }

        return $this->hasMany(TextPageSection::class, 'pageId', 'id')->get();
    }


    /**
     * Add page media
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('small')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->format('jpg')
            ->fit('fill', 600, 315)
            ->quality(80)
            ->nonQueued();


        $this->addMediaConversion('large')
            ->format('jpg')
            ->fit('fill', 1024, 1024)
            ->quality(80)
            ->nonQueued();
    }
}
