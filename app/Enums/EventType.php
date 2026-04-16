<?php

namespace App\Enums;

enum EventType: string
{
    case Wedding = 'wedding';
    case Death = 'death';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Wedding => __('enums.event_type.wedding'),
            self::Death => __('enums.event_type.death'),
            self::Other => __('enums.event_type.other'),
        };
    }
}
