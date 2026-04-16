<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class PasswordResetSession
{
    public static function normalizePhone(string $phone): string
    {
        return trim($phone);
    }

    public static function verifiedKey(string $phone): string
    {
        return 'reset_pw_verified:'.self::normalizePhone($phone);
    }

    public static function ttl(): \DateTimeInterface
    {
        return now()->addMinutes((int) config('password_reset.session_ttl', 15));
    }

    public static function forget(string $phone): void
    {
        Cache::forget(self::verifiedKey($phone));
    }

    public static function markOtpVerified(string $phone): void
    {
        Cache::put(self::verifiedKey($phone), true, self::ttl());
    }

    /** True if a verified session existed and was consumed (one-shot). */
    public static function pullVerified(string $phone): bool
    {
        return (bool) Cache::pull(self::verifiedKey(self::normalizePhone($phone)));
    }
}
