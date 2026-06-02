<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserStatus: string implements HasLabel
{
    case Active = 'active';
    case Pending = 'pending';
    case Rejected = 'rejected';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return match ($this) {
            self::Active => __('enums.status.active'),
            self::Pending => __('enums.status.pending'),
            self::Rejected => __('enums.status.rejected'),
        };
    }
}
