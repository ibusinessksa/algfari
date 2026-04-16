<?php

namespace App\Filament\Widgets;

use App\Enums\JoinRequestStatus;
use App\Models\JoinRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestJoinRequests extends BaseWidget
{
    protected static ?string $heading = 'أحدث طلبات الانضمام';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 50;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                JoinRequest::query()
                    ->where('status', 'pending')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('الاسم'),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('الجوال'),
                Tables\Columns\TextColumn::make('city')
                    ->label('المدينة'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (JoinRequestStatus $state) => match ($state) {
                        JoinRequestStatus::Pending => 'warning',
                        JoinRequestStatus::Approved => 'success',
                        JoinRequestStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->since(),
            ]);
    }
}
