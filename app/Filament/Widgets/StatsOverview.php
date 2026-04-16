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
            Stat::make(__('admin_panel.widgets.stats.total_members'), User::where('status', 'active')->count())
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make(__('admin_panel.widgets.stats.pending_join'), JoinRequest::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make(__('admin_panel.widgets.stats.news'), News::count())
                ->icon('heroicon-o-newspaper')
                ->color('info'),

            Stat::make(__('admin_panel.widgets.stats.upcoming_events'), Event::where('event_date', '>', now())->count())
                ->icon('heroicon-o-calendar')
                ->color('primary'),
        ];
    }
}
