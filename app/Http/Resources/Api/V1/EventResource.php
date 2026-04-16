<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'event_type' => $this->event_type,
            'event_date' => $this->event_date?->toISOString(),
            'end_date' => $this->end_date?->toISOString(),
            'location_name' => $this->location_name,
            'location_lat' => $this->location_lat,
            'location_lng' => $this->location_lng,
            'is_active' => $this->is_active,
            'cover_image' => $this->getFirstMediaUrl('cover_image'),
            'cover_image_medium' => $this->getFirstMediaUrl('cover_image', 'medium'),
            'cover_image_thumb' => $this->getFirstMediaUrl('cover_image', 'thumb'),
            'creator' => new UserResource($this->whenLoaded('creator')),
            'attendees_count' => $this->whenCounted('attendees'),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
