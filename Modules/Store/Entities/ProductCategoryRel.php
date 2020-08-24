<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryRel extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'productId',
        'categoryId',
    ];


    /**
     * @return Model|static
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'categoryId', 'id')->firstOrNew([], []);
    }

    /**
     * @return Model|static
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'id')->firstOrNew([], []);
    }
}
