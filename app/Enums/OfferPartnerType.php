<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OfferPartnerType: string implements HasLabel
{
    case Family = 'family';
    case External = 'external';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return __('enums.offer_partner_type.'.$this->value);
    }
}
