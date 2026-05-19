<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FundInitiativeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'target_amount' => $this->target_amount,
            'raised_amount' => $this->raised_amount,
            'status' => $this->status?->value,
            'is_active' => $this->is_active,
            'start_date' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'cover_image' => $this->getFirstMediaUrl('cover_image'),
            'cover_image_medium' => $this->getFirstMediaUrl('cover_image', 'medium'),
            'cover_image_thumb' => $this->getFirstMediaUrl('cover_image', 'thumb'),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
