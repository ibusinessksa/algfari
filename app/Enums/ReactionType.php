<?php

namespace App\Enums;

enum ReactionType: string
{
    case Like = 'like';
    case Love = 'love';
    case Sad = 'sad';
    case Pray = 'pray';

    public function label(): string
    {
        return __('enums.reaction_type.'.$this->value);
    }
}

