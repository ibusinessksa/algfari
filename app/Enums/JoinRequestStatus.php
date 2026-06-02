<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum JoinRequestStatus: string implements HasLabel
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('enums.join_request_status.pending'),
            self::Approved => __('enums.join_request_status.approved'),
            self::Rejected => __('enums.join_request_status.rejected'),
        };
    }
}
