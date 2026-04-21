<?php

namespace App\Support;

use App\Models\City;
use App\Models\Region;

final class LocationSelectOptions
{
    public static function locale(): string
    {
        $locale = app()->getLocale();

        return in_array($locale, ['ar', 'en'], true) ? $locale : 'ar';
    }

    /**
     * @return array<int, string>
     */
    public static function regions(): array
    {
        $locale = self::locale();

        return Region::query()
            ->orderBy('name->'.$locale)
            ->get()
            ->mapWithKeys(fn (Region $region): array => [
                $region->id => $region->getTranslation('name', $locale)
                    ?: $region->getTranslation('name', 'ar'),
            ])
            ->all();
    }

    /**
     * @return array<int, string>
     */
    public static function citiesForRegion(mixed $regionId): array
    {
        $locale = self::locale();
        $query = City::query()->orderBy('name->'.$locale);

        if (filled($regionId)) {
            $query->where('region_id', $regionId);
        }

        return $query->get()->mapWithKeys(fn (City $city): array => [
            $city->id => $city->getTranslation('name', $locale) ?: $city->getTranslation('name', 'ar'),
        ])->all();
    }
}
