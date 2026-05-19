<?php

namespace App\Enums;

enum OfferCategory: string
{
    case Restaurants = 'restaurants';
    case Stores = 'stores';
    case Services = 'services';
    case Health = 'health';
    case Education = 'education';
    case Travel = 'travel';
    case Tech = 'tech';
    case Other = 'other';

    public function label(): string
    {
        return __('enums.offer_category.'.$this->value);
    }
}

