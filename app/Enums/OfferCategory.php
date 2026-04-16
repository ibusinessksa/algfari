<?php

namespace App\Enums;

enum OfferCategory: string
{
    case Commercial = 'commercial';
    case Contractor = 'contractor';

    public function label(): string
    {
        return match ($this) {
            self::Commercial => __('enums.offer_category.commercial'),
            self::Contractor => __('enums.offer_category.contractor'),
        };
    }
}
