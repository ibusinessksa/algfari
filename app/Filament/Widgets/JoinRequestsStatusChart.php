<?php

namespace App\Filament\Widgets;

use App\Enums\JoinRequestStatus;
use App\Models\JoinRequest;
use Filament\Widgets\ChartWidget;

class JoinRequestsStatusChart extends ChartWidget
{
    protected static ?string $heading = 'طلبات الانضمام حسب الحالة';

    protected static ?int $sort = 3;

    protected static string $color = 'warning';

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $pending = JoinRequest::query()->where('status', JoinRequestStatus::Pending)->count();
        $approved = JoinRequest::query()->where('status', JoinRequestStatus::Approved)->count();
        $rejected = JoinRequest::query()->where('status', JoinRequestStatus::Rejected)->count();

        return [
            'datasets' => [
                [
                    'label' => 'الطلبات',
                    'data' => [$pending, $approved, $rejected],
                    'backgroundColor' => [
                        'rgba(245, 158, 11, 0.85)',
                        'rgba(34, 197, 94, 0.85)',
                        'rgba(239, 68, 68, 0.85)',
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => [
                __('enums.join_request_status.pending'),
                __('enums.join_request_status.approved'),
                __('enums.join_request_status.rejected'),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
