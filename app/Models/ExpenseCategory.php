<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory, SoftDeletes;

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
    public function getSelectedOptions(int $userId): object
    {
        return $this->where('userId', '=', $userId)
            ->get()
            ->pluck('title', 'id');
    }
}
