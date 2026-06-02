<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SupportRequestStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case UnderReview = 'under_review';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Disbursed = 'disbursed';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function getColor(): string | array | null
    {
        return $this->color();
    }

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
