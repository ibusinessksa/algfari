<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'type' => $this->type?->value,
            'partner_type' => $this->partner_type?->value,
            'partner_name' => $this->partner_name,
            'service_address' => $this->service_address,
            'region' => new RegionResource($this->whenLoaded('region')),
            'contact_phone' => $this->contact_phone,
            'contact_whatsapp' => $this->contact_whatsapp,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'offer_image' => $this->getFirstMediaUrl('offer_image'),
            'offer_image_medium' => $this->getFirstMediaUrl('offer_image', 'medium'),
            'offer_image_thumb' => $this->getFirstMediaUrl('offer_image', 'thumb'),
            'gallery' => $this->getMedia('gallery')->map(fn ($m) => [
                'url' => $m->getUrl(),
                'medium' => $m->getUrl('medium'),
                'thumb' => $m->getUrl('thumb'),
            ]),
            'offered_by' => new UserResource($this->whenLoaded('offeredBy')),
            'expires_at' => $this->expires_at?->toISOString(),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
