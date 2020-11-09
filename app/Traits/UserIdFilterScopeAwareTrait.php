<?php


namespace App\Traits;


use App\Scopes\UserIdFilterScope;

trait UserIdFilterScopeAwareTrait
{
    /**
     * Set user id
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($row) {
            $userId = auth()->id();
            $row->userId = $userId;
        });
    }

    /**
     *
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserIdFilterScope());
    }
}
