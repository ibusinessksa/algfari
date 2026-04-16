<?php

namespace App\Filament\Resources;

use App\Enums\FamilyRequestStatus;
use App\Filament\Resources\FamilyRequestResource\Pages;
use App\Models\Family;
use App\Models\FamilyRequest;
use App\Services\FamilyRequestService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyRequestResource extends Resource
{
    protected static ?string $model = FamilyRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?int $navigationSort = 6;

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.members');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.family_request.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.family_request.plural');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) FamilyRequest::query()
            ->where('status', FamilyRequestStatus::Pending)
            ->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->with('user'))
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label(__('admin_panel.common.member'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.pending_family_name')
                    ->label(__('admin_panel.family_request.name_as_entered'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin_panel.family_request.name_key'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (FamilyRequestStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (FamilyRequestStatus $state) => match ($state) {
                        FamilyRequestStatus::Pending => 'warning',
                        FamilyRequestStatus::Approved => 'success',
                        FamilyRequestStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.request_date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(FamilyRequestStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve_link')
                    ->label(__('admin_panel.family_request.link_existing'))
                    ->icon('heroicon-o-link')
                    ->color('success')
                    ->form([
                        Forms\Components\Select::make('family_id')
                            ->label(__('admin_panel.common.family'))
                            ->options(fn () => Family::query()->orderBy('name')->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (FamilyRequest $record, array $data) {
                        $family = Family::query()->findOrFail($data['family_id']);
                        app(FamilyRequestService::class)->approveLinkingToExisting(
                            $record,
                            $family,
                            (int) auth()->id()
                        );

                        FilamentNotification::make()
                            ->title(__('admin_panel.family_request.linked_notification'))
                            ->success()
                            ->send();
                    })
                    ->visible(fn (FamilyRequest $record) => $record->status === FamilyRequestStatus::Pending),

                Tables\Actions\Action::make('approve_create')
                    ->label(__('admin_panel.family_request.create_family'))
                    ->icon('heroicon-o-plus-circle')
                    ->color('primary')
                    ->form([
                        Forms\Components\TextInput::make('family_name')
                            ->label(__('admin_panel.family_request.approved_family_name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('family_origin')
                            ->label(__('admin_panel.common.origin_lineage'))
                            ->maxLength(255),
                    ])
                    ->action(function (FamilyRequest $record, array $data) {
                        app(FamilyRequestService::class)->approveCreatingFamily(
                            $record,
                            $data['family_name'],
                            $data['family_origin'] ?? null,
                            (int) auth()->id()
                        );

                        FilamentNotification::make()
                            ->title(__('admin_panel.family_request.created_notification'))
                            ->success()
                            ->send();
                    })
                    ->visible(fn (FamilyRequest $record) => $record->status === FamilyRequestStatus::Pending),

                Tables\Actions\Action::make('reject')
                    ->label(__('admin_panel.family_request.reject'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label(__('admin_panel.common.rejection_reason'))
                            ->required(),
                    ])
                    ->action(function (FamilyRequest $record, array $data) {
                        app(FamilyRequestService::class)->reject(
                            $record,
                            $data['rejection_reason'],
                            (int) auth()->id()
                        );

                        FilamentNotification::make()
                            ->title(__('admin_panel.family_request.rejected_notification'))
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (FamilyRequest $record) => $record->status === FamilyRequestStatus::Pending),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilyRequests::route('/'),
        ];
    }
}
