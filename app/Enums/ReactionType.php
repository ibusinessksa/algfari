<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ReactionType: string implements HasLabel
{
    case Like = 'like';
    case Love = 'love';
    case Sad = 'sad';
    case Pray = 'pray';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return __('enums.reaction_type.'.$this->value);
    }
}

