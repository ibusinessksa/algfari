<?php

namespace App\Filament\Widgets;

use App\Enums\TransactionStatus;
use App\Models\FamilyFundTransaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class FundTransactionsDailyChart extends ChartWidget
{
    protected static ?string $heading = 'صندوق العائلة — المعاملات المعتمدة (آخر ١٤ يوماً)';

    protected static ?string $description = 'مجموع المبالغ اليومية (ر.س)';

    protected static ?int $sort = 4;

    protected static string $color = 'success';

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $labels = [];
        $values = [];

        for ($i = 13; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i)->startOfDay();
            $labels[] = $day->format('d/m');
            $values[] = (float) FamilyFundTransaction::query()
                ->where('status', TransactionStatus::Approved)
                ->whereDate('created_at', $day->toDateString())
                ->sum('amount');
        }

        return [
            'datasets' => [
                [
                    'label' => 'المبلغ',
                    'data' => $values,
                    'backgroundColor' => 'rgba(22, 163, 74, 0.45)',
                    'borderColor' => 'rgba(22, 163, 74, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
