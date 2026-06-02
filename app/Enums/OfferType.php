<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OfferType: string implements HasLabel
{
    case Commercial = 'commercial';
    case Normal = 'normal';

    public function label(): string
    {
        return __('enums.offer_type.'.$this->value);
    }

    public function getLabel(): string
    {
        return $this->label();
    }
}
