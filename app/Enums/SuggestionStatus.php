<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SuggestionStatus: string implements HasColor, HasLabel
{
    case UnderReview = 'under_review';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case InProgress = 'in_progress';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function getColor(): string | array | null
    {
        return $this->color();
    }

    public function label(): string
    {
        return match ($this) {
            self::UnderReview => __('enums.suggestion_status.under_review'),
            self::Accepted => __('enums.suggestion_status.accepted'),
            self::Rejected => __('enums.suggestion_status.rejected'),
            self::InProgress => __('enums.suggestion_status.in_progress'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::UnderReview => 'warning',
            self::Accepted => 'success',
            self::Rejected => 'danger',
            self::InProgress => 'info',
        };
    }
}
