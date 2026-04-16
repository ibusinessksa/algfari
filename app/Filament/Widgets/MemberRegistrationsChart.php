<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class MemberRegistrationsChart extends ChartWidget
{
    protected static ?string $heading = 'تسجيل الأعضاء (آخر ١٤ يوماً)';

    protected static ?string $description = 'عدد الحسابات الجديدة حسب يوم الإنشاء';

    protected static ?int $sort = 2;

    protected static string $color = 'primary';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $labels = [];
        $values = [];

        for ($i = 13; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i)->startOfDay();
            $labels[] = $day->format('d/m');
            $values[] = User::query()
                ->whereDate('created_at', $day->toDateString())
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'أعضاء جدد',
                    'data' => $values,
                    'borderColor' => '#1B5E3B',
                    'backgroundColor' => 'rgba(27, 94, 59, 0.1)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
