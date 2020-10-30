<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory, SoftDeletes, UserIdFilterScopeAwareTrait;

    /**
     * @var string[]
     */
    public $fillable = [
        'title',
        'userId',
    ];


    /**
     * Before save set user Id
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($row) {
            $row->userId = auth()->id();
        });
    }


    /**
     * @param int $userId
     * @return array
     */
    public function getSelectedOptions(): object
    {
        return $this->get()->pluck('title', 'id');
    }
}
