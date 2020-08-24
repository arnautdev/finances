<?php

namespace Modules\User\Entities;

use App\Traits\AppModelAwareTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Events\RegisterInvitationEvent;

class RegisterInvitation extends Model
{
    use AppModelAwareTrait;

    /**
     * Run events
     * @var array
     */
    public $dispatchesEvents = [
        'created' => RegisterInvitationEvent::class
    ];

    /**
     * Set fillable fields
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'userId',
        'hash',
        'status',
        'guardId',
    ];


    /**
     * Get user
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|null|object
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id')->first();
    }
}
