<?php

namespace App\Filament\Widgets;

use App\Enums\JoinRequestStatus;
use App\Models\JoinRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestJoinRequests extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 50;

    protected function getTableHeading(): ?string
    {
        return __('admin_panel.widgets.latest_join.heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                JoinRequest::query()
                    ->with('region')
                    ->where('status', 'pending')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('admin_panel.common.name')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('admin_panel.common.mobile')),
                Tables\Columns\TextColumn::make('region_id')
                    ->label(__('admin_panel.common.region'))
                    ->formatStateUsing(function (?int $state, JoinRequest $record): string {
                        if (! $record->region) {
                            return '—';
                        }
                        $loc = in_array(app()->getLocale(), ['ar', 'en'], true) ? app()->getLocale() : 'ar';

                        return (string) ($record->region->getTranslation('name', $loc)
                            ?: $record->region->getTranslation('name', 'ar'));
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (JoinRequestStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (JoinRequestStatus $state) => match ($state) {
                        JoinRequestStatus::Pending => 'warning',
                        JoinRequestStatus::Approved => 'success',
                        JoinRequestStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.date'))
                    ->since(),
            ]);
    }
}
