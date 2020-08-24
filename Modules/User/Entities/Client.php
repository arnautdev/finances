<?php

namespace Modules\User\Entities;

use App\Traits\AppModelAwareTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Store\Entities\Order;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Client extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use AppModelAwareTrait, SoftDeletes, HasMediaTrait, Notifiable;

    /**
     * @var string
     */
    protected $guard = 'client';

    /**
     * Set fillable fields
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'company',
        'language',
        'socialId',
        'socialSource',
        'randPassword',
        'userPersonalDataAgreement',
        'userMarketingDataAgreement'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get user orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, 'userId', 'id');
    }

    /**
     * Get client address
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAddress()
    {
        return $this->hasOne(UserAddress::class, 'userId', 'id');
    }

    /**
     * Get all client addresses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getAddresses()
    {
        return $this->hasMany(UserAddress::class, 'userId', 'id');
    }

    /**
     * @return bool
     */
    public function isValidPhone()
    {
        if ($this->phone != '') {
            return true;
        }
        return false;
    }

    /**
     * Get client fullname
     * @return string
     */
    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
