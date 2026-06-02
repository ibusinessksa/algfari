<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum FundInitiativeStatus: string implements HasColor, HasLabel
{
    case Active = 'active';
    case Completed = 'completed';
    case Suspended = 'suspended';

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
            self::Active => __('enums.fund_initiative_status.active'),
            self::Completed => __('enums.fund_initiative_status.completed'),
            self::Suspended => __('enums.fund_initiative_status.suspended'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Completed => 'info',
            self::Suspended => 'gray',
        };
    }
}
