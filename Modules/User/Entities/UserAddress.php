<?php

namespace Modules\User\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;

    /**
     * Fillable fields
     * @var array
     */
    public $fillable = [
        'userId', 'status', 'country', 'city', 'postcode', 'address'
    ];

    /**
     * Get user
     * @return Model|null|object|static
     */
    public function getUser()
    {
        return $this->belongsTo(User::class, 'userId', 'id')->first();
    }
}
