<?php

namespace App\Enums;

enum JoinRequestStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('enums.join_request_status.pending'),
            self::Approved => __('enums.join_request_status.approved'),
            self::Rejected => __('enums.join_request_status.rejected'),
        };
    }
}
