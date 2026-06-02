<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TransactionType: string implements HasLabel
{
    case Donation = 'donation';
    case Expense = 'expense';

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function label(): string
    {
        return match ($this) {
            self::Donation => __('enums.transaction_type.donation'),
            self::Expense => __('enums.transaction_type.expense'),
        };
    }
}
