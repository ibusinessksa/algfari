<?php

namespace App\Enums;

enum RsvpStatus: string
{
    case Going = 'going';
    case Maybe = 'maybe';
    case Declined = 'declined';

    public function label(): string
    {
        return match ($this) {
            self::Going => __('enums.rsvp_status.going'),
            self::Maybe => __('enums.rsvp_status.maybe'),
            self::Declined => __('enums.rsvp_status.declined'),
        };
    }
}
