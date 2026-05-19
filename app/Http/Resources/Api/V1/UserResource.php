<?php

namespace App\Http\Resources\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private static array $authFavoriteIds = [];

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'national_id' => $this->national_id,
            'member_card_number' => $this->member_card_number,
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
            'region_id' => $this->region_id,
            'region' => $this->whenLoaded('region', fn () => $this->region ? [
                'id' => $this->region->id,
                'name' => $this->region->name,
                'country' => [
                    'id' => $this->region->country->id,
                    'name' => $this->region->country->name,
                    'code' => $this->region->country->code,
                ],
            ] : null),
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
            'is_favorited' => $this->isFavoritedBy($request->user()),
            'profile_image' => $this->getFirstMediaUrl('profile_image'),
            'profile_image_medium' => $this->getFirstMediaUrl('profile_image', 'medium'),
            'profile_image_thumb' => $this->getFirstMediaUrl('profile_image', 'thumb'),
            'sons' => $this->whenLoaded('sons', fn () => MemberChildResource::collection($this->sons)),
            'sons_count' => $this->whenLoaded('sons', fn () => $this->sons->count()),
            'daughters' => $this->whenLoaded('daughters', fn () => MemberChildResource::collection($this->daughters)),
            'daughters_count' => $this->whenLoaded('daughters', fn () => $this->daughters->count()),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }

    private function isFavoritedBy(?User $authUser): bool
    {
        if (! $authUser) {
            return false;
        }

        if (! array_key_exists($authUser->id, self::$authFavoriteIds)) {
            self::$authFavoriteIds[$authUser->id] = $authUser->favorites()->pluck('favorited_user_id')->all();
        }

        return in_array($this->id, self::$authFavoriteIds[$authUser->id], true);
    }
}
