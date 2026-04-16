<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Carbon;

class MemberRegistrationsChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static string $color = 'primary';

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): string|Htmlable|null
    {
        return __('admin_panel.widgets.member_reg_chart.heading');
    }

    public function getDescription(): string|Htmlable|null
    {
        return __('admin_panel.widgets.member_reg_chart.description');
    }

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
                    'label' => __('admin_panel.widgets.member_reg_chart.dataset_label'),
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
