<?php

namespace App\Services;

use App\Models\FamilyFundTransaction;

class FundService
{
    public function getSummary(): array
    {
        $approved = FamilyFundTransaction::where('status', 'approved');

        $totalDonations = (float) (clone $approved)
            ->where('transaction_type', 'donation')
            ->sum('amount');

        $totalExpenses = (float) (clone $approved)
            ->where('transaction_type', 'expense')
            ->sum('amount');

        return [
            'total_donations' => $totalDonations,
            'total_expenses' => $totalExpenses,
            'balance' => $totalDonations - $totalExpenses,
            'transactions_count' => $approved->count(),
        ];
    }
}
