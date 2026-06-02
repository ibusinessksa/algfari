<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RsvpStatus: string implements HasLabel
{
    case Going = 'going';
    case Maybe = 'maybe';
    case Declined = 'declined';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return match ($this) {
            self::Going => __('enums.rsvp_status.going'),
            self::Maybe => __('enums.rsvp_status.maybe'),
            self::Declined => __('enums.rsvp_status.declined'),
        };
    }
}

