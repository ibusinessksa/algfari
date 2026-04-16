<?php

namespace App\Enums;

enum TransactionType: string
{
    case Donation = 'donation';
    case Expense = 'expense';

    public function label(): string
    {
        return match ($this) {
            self::Donation => __('enums.transaction_type.donation'),
            self::Expense => __('enums.transaction_type.expense'),
        };
    }
}
