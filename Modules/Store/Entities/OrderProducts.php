<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'orderId',
        'productId',
        'price',
        'qty',
        'promoPrice',
        'inPromo',
        'attributes',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($row) {
            $row->decrementAvailableCount($row);
        });
    }

    /**
     * Get product
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'productId', 'id')->first();
    }

    /**
     * @param OrderProducts $orderProduct
     */
    public function decrementAvailableCount(OrderProducts $orderProduct)
    {
        $key = $orderProduct->getProductOptionKey();
        $productOption = ProductOptions::where('optionKey', '=', $key)->first();
        if ($productOption->exists) {
            $data['availableCount'] = ($productOption->availableCount - $orderProduct->qty);
            $productOption->update($data);
            unset($productOption);
        }
    }


    /**
     * Increment product availability when order status set [cancelled, returned]
     */
    public function incrementAvailableCount()
    {
        $productOptionKey = $this->getProductOptionKey();
        $productOption = ProductOptions::where('optionKey', '=', $productOptionKey)->firstOrNew([], []);
        if ($productOption->exists) {
            $data['availableCount'] = ($productOption->availableCount + $this->qty);
            $productOption->update($data);
        }
    }

    /**
     * @return string
     */
    public function getProductOptionKey()
    {
        $attributes = (array)json_decode($this->attributes['attributes']);
        return implode(':', $attributes);
    }
}
