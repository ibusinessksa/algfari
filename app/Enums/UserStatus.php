<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'active';
    case Pending = 'pending';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Active => __('enums.status.active'),
            self::Pending => __('enums.status.pending'),
            self::Rejected => __('enums.status.rejected'),
        };
    }
}
