<?php

namespace App\Enums;

enum UserRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Member = 'member';
    case FamilyBusinessOwner = 'family_business_owner';
    case ExternalPartner = 'external_partner';

    public function label(): string
    {
        return __('enums.role.'.$this->value);
    }
}
