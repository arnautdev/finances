<?php

namespace App;

use App\Traits\AppModelAwareTrait;
use App\Observers\NewUserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\User\Entities\UserAddress;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\ResponsiveImages\TinyPlaceholderGenerator\TinyPlaceholderGenerator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use AppModelAwareTrait, Notifiable, HasRoles, HasMediaTrait;

    const SUPER_ADMIN = 1;
    const ADMINISTRATOR = 2;
    const BUSINESS = 3;
    const EMPLOYEE = 4;
    const MODERATOR = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'company', 'email', 'firstname', 'lastname', 'language',
        'password', 'timezone', 'phone', 'socialId', 'socialSource'
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
     * Get user fullname
     * @return string
     */
    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Get user language
     * @return string
     */
    public function getLanguage()
    {
        return 'English';
    }

    /**
     * Get user role
     * @return string
     */
    public function getRole()
    {
        $roles = $this->getRoleNames();
        if ($roles->count() > 0) {
            return $roles->implode('');
        }
        return '--';
    }

    /**
     * Get role id
     * @return int|mixed
     */
    public function getRoleId()
    {
        $roles = $this->getRoleNames();
        if ($roles->count() > 0) {
            return Role::findByName($roles->first())->id;
        }
        return 0;
    }

    /**
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->clearMediaCollection('avatar');
        $this->addMediaConversion('avatar')
            ->format('jpg')
            ->fit('fill', 150, 150)
            ->quality(80)
            ->nonQueued();
    }

    /**
     * Get user avatar
     * @return string
     */
    public function getAvatar()
    {
        $user = auth()->user();
        if (is_object($user->getMedia()->last())) {
            return $user->getMedia()->last()->getUrl('avatar');
        }

        // else generate placeholder
        $Initials = mb_substr($user->firstname, 0, 1) . ' ' . mb_substr($user->lastname, 0, 1);
        return 'https://via.placeholder.com/120/33414E/fff/?text=' . urlencode($Initials);
    }

    /**
     * Get user address
     * @param bool $all
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getUserAddress($all = false)
    {
        // return all active addresses
        if ($all === true) {
            return $this->hasMany(UserAddress::class, 'userId', 'id')
                ->where('status', '=', 'active')
                ->get();
        }

        // return last active address
        $userAddress = $this->hasOne(UserAddress::class, 'userId', 'id')
            ->where('status', '=', 'active')
            ->orderBy('id', 'DESC')
            ->first();
        if (is_null($userAddress)) {
            return (new UserAddress());
        }
        return $userAddress;
    }
}
