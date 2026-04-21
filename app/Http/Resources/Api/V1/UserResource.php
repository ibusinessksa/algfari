<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'national_id' => $this->national_id,
            'email' => $this->email,
            'family' => $this->whenLoaded(
                'family',
                fn () => $this->family ? new FamilyResource($this->family) : null
            ),
            'pending_family' => $this->when(
                filled($this->pending_family_name),
                [
                    'name' => $this->pending_family_name,
                    'status' => 'pending_admin_review',
                ]
            ),
            'workplace' => $this->workplace,
            'current_job' => $this->current_job,
            'city' => $this->whenLoaded('city', fn () => $this->city ? [
                'id' => $this->city->id,
                'name' => $this->city->name,
                'region' => [
                    'id' => $this->city->region->id,
                    'name' => $this->city->region->name,
                    'country' => [
                        'id' => $this->city->region->country->id,
                        'name' => $this->city->region->country->name,
                        'code' => $this->city->region->country->code,
                    ],
                ],
            ] : null),
            'bio' => $this->bio,
            'gender' => $this->gender,
            'role' => $this->role,
            'status' => $this->status,
            'social_links' => $this->social_links,
            'is_featured' => $this->is_featured,
            'profile_image' => $this->getFirstMediaUrl('profile_image'),
            'profile_image_medium' => $this->getFirstMediaUrl('profile_image', 'medium'),
            'profile_image_thumb' => $this->getFirstMediaUrl('profile_image', 'thumb'),
            'sons' => $this->whenLoaded('sons', fn () => MemberChildResource::collection($this->sons)),
            'daughters' => $this->whenLoaded('daughters', fn () => MemberChildResource::collection($this->daughters)),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
