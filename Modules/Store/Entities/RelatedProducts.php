<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;

class RelatedProducts extends Model
{
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = [
        'productId',
        'relatedProductId',
    ];

    /**
     * Get product
     * @return Model|static
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'relatedProductId', 'id')->firstOrNew([], []);
    }
}
