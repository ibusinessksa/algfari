<?php

namespace App\Enums;

enum SupportRequestStatus: string
{
    case Pending = 'pending';
    case UnderReview = 'under_review';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Disbursed = 'disbursed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('enums.support_request_status.pending'),
            self::UnderReview => __('enums.support_request_status.under_review'),
            self::Approved => __('enums.support_request_status.approved'),
            self::Rejected => __('enums.support_request_status.rejected'),
            self::Disbursed => __('enums.support_request_status.disbursed'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'gray',
            self::UnderReview => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
            self::Disbursed => 'info',
        };
    }
}
