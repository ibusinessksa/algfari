<?php

namespace App\Enums;

enum SuggestionStatus: string
{
    case Pending = 'pending';
    case Reviewed = 'reviewed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('enums.suggestion_status.pending'),
            self::Reviewed => __('enums.suggestion_status.reviewed'),
        };
    }
}
