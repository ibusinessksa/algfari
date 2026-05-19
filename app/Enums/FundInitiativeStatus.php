<?php

namespace App\Enums;

enum FundInitiativeStatus: string
{
    case Active = 'active';
    case Completed = 'completed';
    case Suspended = 'suspended';

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
