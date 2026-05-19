<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FundProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'about' => $this->about,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'goals' => $this->goals,
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
