<?php


namespace App\Traits;


use App\Scopes\UserIdFilterScope;

trait UserIdFilterScopeAwareTrait
{
    /**
     *
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserIdFilterScope());
    }
}
