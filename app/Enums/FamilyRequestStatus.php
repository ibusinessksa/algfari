<?php

namespace App\Enums;

enum FamilyRequestStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('enums.family_request_status.pending'),
            self::Approved => __('enums.family_request_status.approved'),
            self::Rejected => __('enums.family_request_status.rejected'),
        };
    }
}
