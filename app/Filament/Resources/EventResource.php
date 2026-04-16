<?php

namespace App\Filament\Resources;

use App\Enums\EventType;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.event.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.event.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.event.section'))->schema([
                Forms\Components\Tabs::make('translations')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))
                            ->schema([
                                Forms\Components\TextInput::make('title.ar')
                                    ->label(__('admin_panel.common.title'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description.ar')
                                    ->label(__('admin_panel.common.description'))
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->label(__('admin_panel.common.title'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description.en')
                                    ->label(__('admin_panel.common.description'))
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Select::make('event_type')
                    ->label(__('admin_panel.event.event_type'))
                    ->options(EventType::class)
                    ->required(),

                Forms\Components\DateTimePicker::make('event_date')
                    ->label(__('admin_panel.common.start_date'))
                    ->required(),

                Forms\Components\DateTimePicker::make('end_date')
                    ->label(__('admin_panel.common.end_date')),

                Forms\Components\TextInput::make('location_name')
                    ->label(__('admin_panel.common.location_name')),

                Forms\Components\TextInput::make('location_lat')
                    ->label(__('admin_panel.common.latitude'))
                    ->numeric(),

                Forms\Components\TextInput::make('location_lng')
                    ->label(__('admin_panel.common.longitude'))
                    ->numeric(),

                Forms\Components\Select::make('created_by')
                    ->label(__('admin_panel.common.creator'))
                    ->relationship('creator', 'full_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->default(true),

                Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                    ->label(__('admin_panel.common.cover_image'))
                    ->collection('cover_image')
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('cover_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('event_type')
                    ->label(__('admin_panel.common.type'))
                    ->formatStateUsing(fn (EventType $state): string => $state->label())
                    ->badge(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label(__('admin_panel.common.date'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('creator.full_name')
                    ->label(__('admin_panel.common.creator')),
                Tables\Columns\TextColumn::make('attendees_count')
                    ->label(__('admin_panel.common.attendees'))
                    ->counts('attendees'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->boolean(),
            ])
            ->defaultSort('event_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('event_type')
                    ->options(EventType::class),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('admin_panel.common.active')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
