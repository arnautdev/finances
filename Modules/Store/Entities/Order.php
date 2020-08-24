<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Client;
use Modules\User\Entities\UserAddress;

class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'userId',
        'userAddressId',
        'processedByUserId',
        'status',
        'price',
        'currency',
        'paymentMethod',
        'additionalOrderInfo',
    ];


    /**
     * Get status class
     * @return string
     */
    public function getStatusClass()
    {
        $statuses = [
            'new' => 'bg-warning',
            'processing' => 'bg-primary',
            'toSend' => 'bg-success',
            'send' => 'bg-info',
            'cancelled' => 'bg-danger',
            'returned' => 'bg-danger',
        ];

        if (isset($statuses[$this->status])) {
            return $statuses[$this->status];
        }
        return '';
    }

    /**
     * Get available statuses
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            'new' => __('New'),
            'processing' => __('Processing'),
            'toSend' => __('To send'),
            'send' => __('Send'),
            'cancelled' => __('Cancelled'),
            'returned' => __('Returned'),
        ];
    }

    public function getPaymentMethodLabel()
    {
        return __(ucfirst($this->paymentMethod));
    }

    /**
     * @return array|string|null
     */
    public function getStatusLabel()
    {
        return __(ucfirst($this->status));
    }

    /**
     * Get order products
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProducts()
    {
        return $this->hasMany(OrderProducts::class, 'orderId', 'id');
    }

    /**
     * Get order address
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function getAddress()
    {
        return $this->belongsTo(UserAddress::class, 'userAddressId', 'id')->first();
    }

    /**
     * Get client
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function getClient()
    {
        return $this->belongsTo(Client::class, 'userId', 'id')->first();
    }

    /**
     * Get client model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getClientModel()
    {
        return $this->belongsTo(Client::class, 'userId', 'id');
    }
}
