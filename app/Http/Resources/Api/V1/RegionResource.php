<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'name' => [
                'ar' => $this->getTranslation('name', 'ar'),
                'en' => $this->getTranslation('name', 'en'),
            ],
            'cities_count' => $this->whenCounted('cities'),
            'country' => $this->whenLoaded('country', function () {
                return [
                    'id' => $this->country->id,
                    'code' => $this->country->code,
                    'name' => [
                        'ar' => $this->country->getTranslation('name', 'ar'),
                        'en' => $this->country->getTranslation('name', 'en'),
                    ],
                ];
            }),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
