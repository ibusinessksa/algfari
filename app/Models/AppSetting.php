<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppSetting extends Model
{
    protected $table = 'app_settings';

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('contact_info'));
    }

    protected $fillable = [
        'contact_phone',
        'contact_whatsapp',
        'contact_email',
        'twitter_url',
        'instagram_url',
        'snapchat_url',
        'tiktok_url',
        'youtube_url',
    ];

    public static function current(): self
    {
        return self::query()->firstOrCreate(['id' => 1]);
    }
}
