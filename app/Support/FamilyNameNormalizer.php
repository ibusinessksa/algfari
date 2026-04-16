<?php

namespace App\Support;

use Illuminate\Support\Str;

class FamilyNameNormalizer
{
    /**
     * Normalize for deduplication and unique index (trim, collapse spaces, Arabic letter variants, case).
     */
    public static function normalize(string $value): string
    {
        $s = Str::squish($value);

        if ($s === '') {
            return '';
        }

        if (class_exists(\Normalizer::class) && \Normalizer::isNormalized($s, \Normalizer::FORM_C)) {
            $s = \Normalizer::normalize($s, \Normalizer::FORM_C) ?: $s;
        }

        $s = str_replace("\u{0640}", '', $s);

        static $map = [
            'أ' => 'ا', 'إ' => 'ا', 'آ' => 'ا', 'ٱ' => 'ا',
            'ى' => 'ي', 'ئ' => 'ي',
            'ة' => 'ه',
            'ؤ' => 'و',
        ];

        $s = strtr($s, $map);

        return mb_strtolower($s, 'UTF-8');
    }
}
