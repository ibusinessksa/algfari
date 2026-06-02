<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum NewsCommentStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

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
        return __('enums.news_comment_status.'.$this->value);
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Rejected => 'danger',
        };
    }
}
