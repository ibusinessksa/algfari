<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('enums.transaction_status.pending'),
            self::Approved => __('enums.transaction_status.approved'),
            self::Rejected => __('enums.transaction_status.rejected'),
        };
    }
}
