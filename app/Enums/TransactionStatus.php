<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TransactionStatus: string implements HasLabel
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
            self::Pending => __('enums.transaction_status.pending'),
            self::Approved => __('enums.transaction_status.approved'),
            self::Rejected => __('enums.transaction_status.rejected'),
        };
    }
}
