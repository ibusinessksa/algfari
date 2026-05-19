<?php

namespace App\Enums;

enum OfferPartnerType: string
{
    case Family = 'family';
    case External = 'external';

    public function label(): string
    {
        return __('enums.offer_partner_type.'.$this->value);
    }
}
