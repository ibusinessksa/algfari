<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum EventType: string implements HasLabel
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

    public function getLabel(): string
    {
        return $this->label();
    }
}

