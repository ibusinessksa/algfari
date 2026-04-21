<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'code',
    ];

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }

    public function cities(): HasManyThrough
    {
        return $this->hasManyThrough(City::class, Region::class);
    }
}
