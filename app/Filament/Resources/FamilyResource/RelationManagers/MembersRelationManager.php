<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use App\Enums\UserStatus;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string
    {
        return __('admin_panel.members_relation.title');
    }

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('admin_panel.common.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('admin_panel.common.mobile'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('admin_panel.common.email'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('admin_panel.common.city'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (UserStatus $state): string => $state->label())
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.join_date'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('full_name')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(UserStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('edit_member')
                    ->label(__('admin_panel.members_relation.edit_member'))
                    ->icon('heroicon-o-pencil-square')
                    ->url(fn (User $record): string => UserResource::getUrl('edit', ['record' => $record])),
            ])
            ->emptyStateHeading(__('admin_panel.members_relation.empty_heading'))
            ->emptyStateDescription(__('admin_panel.members_relation.empty_description'));
    }
}
