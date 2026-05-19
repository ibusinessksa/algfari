<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'amount_requested' => $this->amount_requested,
            'amount_granted' => $this->amount_granted,
            'status' => $this->status?->value,
            'admin_notes' => $this->admin_notes,
            'reviewed_at' => $this->reviewed_at?->toISOString(),
            'attachments' => $this->getMedia('attachments')->map(fn ($m) => [
                'id' => $m->id,
                'url' => $m->getUrl(),
                'name' => $m->name,
                'mime_type' => $m->mime_type,
            ])->all(),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
