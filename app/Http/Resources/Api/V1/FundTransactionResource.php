<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FundTransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'transaction_type' => $this->transaction_type,
            'description' => $this->description,
            'status' => $this->status,
            'receipt' => $this->getFirstMediaUrl('receipt'),
            'receipt_thumb' => $this->getFirstMediaUrl('receipt', 'thumb'),
            'contributor' => new UserResource($this->whenLoaded('contributor')),
            'approved_at' => $this->approved_at?->toISOString(),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
