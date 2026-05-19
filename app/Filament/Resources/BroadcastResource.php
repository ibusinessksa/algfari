<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BroadcastResource\Pages;
use App\Jobs\DispatchBroadcast;
use App\Models\Broadcast;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BroadcastResource extends Resource
{
    protected static ?string $model = Broadcast::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.communication');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.broadcast.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.broadcast.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.broadcast.section'))->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin_panel.common.title'))->required()->maxLength(255),
                Forms\Components\Textarea::make('body')
                    ->label(__('admin_panel.common.content'))->required()->rows(5)->columnSpanFull(),

                Forms\Components\Select::make('audience_type')
                    ->label(__('admin_panel.broadcast.audience'))
                    ->options([
                        'all' => __('admin_panel.broadcast.audience_options.all'),
                        'region' => __('admin_panel.broadcast.audience_options.region'),
                        'family' => __('admin_panel.broadcast.audience_options.family'),
                        'role' => __('admin_panel.broadcast.audience_options.role'),
                    ])->required()->default('all')->live(),

                Forms\Components\Select::make('audience_filter.region_id')
                    ->label(__('admin_panel.common.region'))
                    ->visible(fn (Get $get) => $get('audience_type') === 'region')
                    ->options(fn () => \App\Models\Region::all()->mapWithKeys(
                        fn ($r) => [$r->id => $r->getTranslation('name', 'ar')]
                    )),

                Forms\Components\Select::make('audience_filter.family_id')
                    ->label(__('admin_panel.common.family'))
                    ->visible(fn (Get $get) => $get('audience_type') === 'family')
                    ->options(fn () => \App\Models\Family::all()->pluck('name', 'id')),

                Forms\Components\Select::make('audience_filter.role')
                    ->label(__('admin_panel.common.role'))
                    ->visible(fn (Get $get) => $get('audience_type') === 'role')
                    ->options(['admin' => 'Admin', 'member' => 'Member']),

                Forms\Components\CheckboxList::make('channels')
                    ->label(__('admin_panel.broadcast.channels'))
                    ->options([
                        'email' => 'Email',
                        'sms' => 'SMS',
                        'push' => 'Push (FCM)',
                    ])
                    ->default(['email'])
                    ->required()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->searchable()->limit(40),
                Tables\Columns\TextColumn::make('audience_type')
                    ->label(__('admin_panel.broadcast.audience'))
                    ->badge(),
                Tables\Columns\TextColumn::make('recipients_count')
                    ->label(__('admin_panel.broadcast.recipients_count')),
                Tables\Columns\TextColumn::make('sent_at')
                    ->label(__('admin_panel.broadcast.sent_at'))
                    ->dateTime()
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.created_at'))
                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('send')
                    ->label(__('admin_panel.broadcast.send_now'))
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->visible(fn (Broadcast $r) => ! $r->sent_at)
                    ->requiresConfirmation()
                    ->action(function (Broadcast $r) {
                        $r->update(['sent_by' => auth()->id()]);
                        DispatchBroadcast::dispatch($r->id);
                        Notification::make()
                            ->title(__('messages.broadcast_dispatched'))
                            ->success()
                            ->send();
                    }),
                Tables\Actions\EditAction::make()->visible(fn (Broadcast $r) => ! $r->sent_at),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBroadcasts::route('/'),
            'create' => Pages\CreateBroadcast::route('/create'),
            'edit' => Pages\EditBroadcast::route('/{record}/edit'),
        ];
    }
}
