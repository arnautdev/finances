<?php

namespace App\Models;

use App\Traits\UserIdFilterScopeAwareTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory, UserIdFilterScopeAwareTrait;

    /**
     * @var string[]
     */
    public $fillable = [
        'userId',
        'settingsKey',
        'settingsValue'
    ];

    /**
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->userId = auth()->id();
        });
    }


    /**
     * @param $key
     * @param $val
     * @return false
     */
    public function addSettingsKey(string $key, string $val)
    {
        $row = $this->where('settingsKey', '=', $key)->firstOrNew([], []);
        if ($row->exists) {
            return $row->settingsValue;
        }

        $row = self::create([
            'settingsKey' => $key,
            'settingsValue' => $val
        ]);

        return $row->settingsValue;
    }

    /**
     * @param $key
     * @param null $default
     * @return false
     */
    public function getSettingsKey(string $key, $default = null)
    {
        $row = $this->where('settingsKey', '=', $key)->firstOrNew([], []);
        if (!$row->exists && !is_null($default)) {
            return $this->addSettingsKey($key, $default)->settingsValue;
        }

        if ($row->exists) {
            return $row->settingsValue;
        }

        return false;
    }
}
