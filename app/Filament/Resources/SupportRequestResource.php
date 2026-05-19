<?php

namespace App\Filament\Resources;

use App\Enums\SupportRequestStatus;
use App\Filament\Resources\SupportRequestResource\Pages;
use App\Models\SupportRequest;
use App\Notifications\SupportRequestReviewed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class SupportRequestResource extends Resource
{
    protected static ?string $model = SupportRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.finance');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.support_request.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.support_request.plural');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) SupportRequest::where('status', SupportRequestStatus::Pending)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.support_request.section'))->schema([
                Forms\Components\Select::make('user_id')
                    ->label(__('admin_panel.common.member'))
                    ->relationship('user', 'full_name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn ($record) => $record !== null),

                Forms\Components\TextInput::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label(__('admin_panel.common.description'))
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('amount_requested')
                    ->label(__('admin_panel.support_request.amount_requested'))
                    ->numeric()
                    ->prefix('SAR'),

                Forms\Components\TextInput::make('amount_granted')
                    ->label(__('admin_panel.support_request.amount_granted'))
                    ->numeric()
                    ->prefix('SAR'),

                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(SupportRequestStatus::class)
                    ->required(),

                Forms\Components\Textarea::make('admin_notes')
                    ->label(__('admin_panel.support_request.admin_notes'))
                    ->rows(3)
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('attachments')
                    ->label(__('admin_panel.support_request.attachments'))
                    ->collection('attachments')
                    ->multiple()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label(__('admin_panel.common.submitter'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount_requested')
                    ->label(__('admin_panel.support_request.amount_requested'))
                    ->money('SAR'),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (SupportRequestStatus $state) => $state->label())
                    ->badge()
                    ->color(fn (SupportRequestStatus $state) => $state->color()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(SupportRequestStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label(__('admin_panel.support_request.approve'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('amount_granted')
                            ->label(__('admin_panel.support_request.amount_granted'))
                            ->numeric()
                            ->prefix('SAR')
                            ->default(fn (SupportRequest $record) => $record->amount_requested),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label(__('admin_panel.support_request.admin_notes'))
                            ->rows(3),
                    ])
                    ->action(function (SupportRequest $record, array $data): void {
                        $record->update([
                            'status' => SupportRequestStatus::Approved,
                            'amount_granted' => $data['amount_granted'] ?? $record->amount_requested,
                            'admin_notes' => $data['admin_notes'] ?? $record->admin_notes,
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);

                        $record->user?->notify(new SupportRequestReviewed($record->fresh()));

                        FilamentNotification::make()
                            ->title(__('admin_panel.support_request.approved_notification'))
                            ->success()
                            ->send();
                    })
                    ->visible(fn (SupportRequest $record) => \in_array(
                        $record->status,
                        [SupportRequestStatus::Pending, SupportRequestStatus::UnderReview],
                        true,
                    )),

                Tables\Actions\Action::make('reject')
                    ->label(__('admin_panel.support_request.reject'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label(__('admin_panel.support_request.rejection_reason'))
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (SupportRequest $record, array $data): void {
                        $record->update([
                            'status' => SupportRequestStatus::Rejected,
                            'admin_notes' => $data['admin_notes'],
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);

                        $record->user?->notify(new SupportRequestReviewed($record->fresh()));

                        FilamentNotification::make()
                            ->title(__('admin_panel.support_request.rejected_notification'))
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (SupportRequest $record) => \in_array(
                        $record->status,
                        [SupportRequestStatus::Pending, SupportRequestStatus::UnderReview],
                        true,
                    )),

                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupportRequests::route('/'),
            'create' => Pages\CreateSupportRequest::route('/create'),
            'edit' => Pages\EditSupportRequest::route('/{record}/edit'),
        ];
    }
}
