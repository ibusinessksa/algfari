<?php

namespace App\Filament\Resources;

use App\Enums\JoinRequestStatus;
use App\Filament\Resources\JoinRequestResource\Pages;
use App\Models\JoinRequest;
use App\Notifications\JoinRequestRejected;
use App\Services\JoinRequestService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JoinRequestResource extends Resource
{
    protected static ?string $model = JoinRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.members');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.join_request.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.join_request.plural');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) JoinRequest::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.join_request.section'))->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label(__('admin_panel.common.full_name'))
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->label(__('admin_panel.common.phone'))
                    ->required(),
                Forms\Components\TextInput::make('national_id')
                    ->label(__('admin_panel.common.national_id')),
                Forms\Components\TextInput::make('email')
                    ->label(__('admin_panel.common.email')),
                Forms\Components\TextInput::make('pending_family_name')
                    ->label(__('admin_panel.join_request.family_name_pending'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label(__('admin_panel.common.city')),
                Forms\Components\TextInput::make('region')
                    ->label(__('admin_panel.common.region')),
                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(JoinRequestStatus::class)
                    ->disabled(),
                Forms\Components\Textarea::make('rejection_reason')
                    ->label(__('admin_panel.common.rejection_reason'))
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('profile_image')
                    ->label(__('admin_panel.common.profile_image'))
                    ->collection('profile_image')
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('profile_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('profile_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('admin_panel.common.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('admin_panel.common.mobile'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('pending_family_name')
                    ->label(__('admin_panel.join_request.requested_family'))
                    ->toggleable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('admin_panel.common.city'))
                    ->toggleable(),
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
                    ->label(__('admin_panel.common.request_date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(JoinRequestStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label(__('admin_panel.join_request.approve'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (JoinRequest $record) {
                        app(JoinRequestService::class)->approve($record, (int) auth()->id());

                        FilamentNotification::make()
                            ->title(__('admin_panel.join_request.approved_notification'))
                            ->success()
                            ->send();
                    })
                    ->visible(fn (JoinRequest $record) => $record->status === JoinRequestStatus::Pending),

                Tables\Actions\Action::make('reject')
                    ->label(__('admin_panel.join_request.reject'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label(__('admin_panel.common.rejection_reason'))
                            ->required(),
                    ])
                    ->action(function (JoinRequest $record, array $data) {
                        $record->update([
                            'status' => JoinRequestStatus::Rejected,
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                            'rejection_reason' => $data['rejection_reason'],
                        ]);

                        if ($record->user) {
                            $record->user->notify(new JoinRequestRejected($data['rejection_reason']));
                        }

                        FilamentNotification::make()
                            ->title(__('admin_panel.join_request.rejected_notification'))
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (JoinRequest $record) => $record->status === JoinRequestStatus::Pending),

                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJoinRequests::route('/'),
        ];
    }
}
