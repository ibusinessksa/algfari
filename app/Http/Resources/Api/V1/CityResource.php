<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'name' => [
                'ar' => $this->getTranslation('name', 'ar'),
                'en' => $this->getTranslation('name', 'en'),
            ],
            'region' => $this->whenLoaded('region', function () {
                $region = $this->region;

                return [
                    'id' => $region->id,
                    'country_id' => $region->country_id,
                    'name' => [
                        'ar' => $region->getTranslation('name', 'ar'),
                        'en' => $region->getTranslation('name', 'en'),
                    ],
                    'country' => $region->relationLoaded('country') && $region->country ? [
                        'id' => $region->country->id,
                        'code' => $region->country->code,
                        'name' => [
                            'ar' => $region->country->getTranslation('name', 'ar'),
                            'en' => $region->country->getTranslation('name', 'en'),
                        ],
                    ] : null,
                ];
            }),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
