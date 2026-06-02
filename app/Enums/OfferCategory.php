<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OfferCategory: string implements HasLabel
{
    case Restaurants = 'restaurants';
    case Stores = 'stores';
    case Services = 'services';
    case Health = 'health';
    case Education = 'education';
    case Travel = 'travel';
    case Tech = 'tech';
    case Other = 'other';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return __('enums.offer_category.'.$this->value);
    }
}

