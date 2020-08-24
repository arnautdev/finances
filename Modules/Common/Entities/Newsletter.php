<?php

namespace Modules\Common\Entities;

use App\Traits\AppModelAwareTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{
    use AppModelAwareTrait, SoftDeletes;
    
    /**
     * Set fillable fields
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'agreementWithTerms',
    ];
}
