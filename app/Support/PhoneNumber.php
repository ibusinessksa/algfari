<?php

namespace App\Support;

/**
 * Normalizes Saudi mobile numbers to canonical form {@code 05XXXXXXXX} (10 digits).
 */
final class PhoneNumber
{
    /**
     * Accepts values such as {@code 0551234567}, {@code 551234567}, {@code +966551234567}.
     * Returns null if the digits cannot be interpreted as a Saudi mobile.
     */
    public static function normalizeSaMobile(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $value) ?? '';

        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '966')) {
            $rest = substr($digits, 3);
            if (str_starts_with($rest, '0')) {
                $rest = substr($rest, 1);
            }
            if (strlen($rest) === 9 && str_starts_with($rest, '5')) {
                return '0'.$rest;
            }
        }

        if (strlen($digits) === 10 && str_starts_with($digits, '05')) {
            return $digits;
        }

        if (strlen($digits) === 9 && str_starts_with($digits, '5')) {
            return '0'.$digits;
        }

        return null;
    }
}
