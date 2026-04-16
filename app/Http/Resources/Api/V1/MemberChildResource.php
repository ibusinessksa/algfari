<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\MemberSon|\App\Models\MemberDaughter
 */
class MemberChildResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->displayName(),
            'linked_user_id' => $this->linked_user_id,
            'linked_user' => $this->when(
                $this->relationLoaded('linkedUser') && $this->linkedUser !== null,
                fn () => [
                    'id' => $this->linkedUser->id,
                    'full_name' => $this->linkedUser->full_name,
                    'profile_image_thumb' => $this->linkedUser->getFirstMediaUrl('profile_image', 'thumb'),
                ]
            ),
        ];
    }
}
