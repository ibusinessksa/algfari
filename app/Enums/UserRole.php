<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Member = 'member';
    case FamilyBusinessOwner = 'family_business_owner';
    case ExternalPartner = 'external_partner';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return __('enums.role.'.$this->value);
    }
}
