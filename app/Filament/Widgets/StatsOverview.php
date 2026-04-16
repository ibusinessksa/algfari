<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\JoinRequest;
use App\Models\News;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي الأعضاء', User::where('status', 'active')->count())
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('طلبات الانضمام المعلقة', JoinRequest::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('الأخبار', News::count())
                ->icon('heroicon-o-newspaper')
                ->color('info'),

            Stat::make('المناسبات القادمة', Event::where('event_date', '>', now())->count())
                ->icon('heroicon-o-calendar')
                ->color('primary'),
        ];
    }
}
