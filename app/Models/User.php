<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getMonthlyExpenses()
    {
        return $this->hasMany(MonthlyExpenses::class, 'userId', 'id');
    }

    /**
     * Get expenses
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getExpenses()
    {
        return $this->hasMany(Expenses::class, 'userId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function todoList()
    {
        return $this->hasMany(TodoList::class, 'userId', 'id');
    }

    public function expenseCategory()
    {
        return $this->hasMany(ExpenseCategory::class, 'userId', 'id');
    }

    public function expense()
    {
        return $this->hasMany(Expenses::class, 'userId', 'id');
    }

    public function monthlyExpense()
    {
        return $this->hasMany(MonthlyExpenses::class, 'userId', 'id');
    }
}
