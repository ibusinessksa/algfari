<?php

namespace App\Enums;

enum EventType: string
{
    case Eid = 'eid';
    case Wedding = 'wedding';
    case Condolence = 'condolence';
    case Trip = 'trip';
    case Meeting = 'meeting';
    case Conference = 'conference';
    case Other = 'other';

    public function label(): string
    {
        return __('enums.event_type.'.$this->value);
    }
}

