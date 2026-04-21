<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JoinRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'national_id' => $this->national_id,
            'email' => $this->email,
            'pending_family_name' => $this->pending_family_name,
            'region_id' => $this->region_id,
            'region' => $this->whenLoaded('region', fn () => $this->region ? [
                'id' => $this->region->id,
                'country_id' => $this->region->country_id,
                'name' => [
                    'ar' => $this->region->getTranslation('name', 'ar'),
                    'en' => $this->region->getTranslation('name', 'en'),
                ],
            ] : null),
            'status' => $this->status,
            'rejection_reason' => $this->rejection_reason,
            'profile_image' => $this->getFirstMediaUrl('profile_image'),
            'profile_image_medium' => $this->getFirstMediaUrl('profile_image', 'medium'),
            'profile_image_thumb' => $this->getFirstMediaUrl('profile_image', 'thumb'),
            'reviewed_at' => $this->reviewed_at?->toISOString(),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
