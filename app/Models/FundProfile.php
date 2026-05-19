<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FundProfile extends Model
{
    use HasTranslations;

    protected $table = 'fund_profile';

    public array $translatable = ['about', 'vision', 'mission', 'goals'];

    protected $fillable = ['about', 'vision', 'mission', 'goals'];

    protected function casts(): array
    {
        return [
            'about' => 'json',
            'vision' => 'json',
            'mission' => 'json',
            'goals' => 'json',
        ];
    }

    public static function current(): self
    {
        return self::query()->firstOrCreate(['id' => 1]);
    }
}
