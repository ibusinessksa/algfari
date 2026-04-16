<?php

namespace App\Filament\Resources;

use App\Enums\OfferCategory;
use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.offer.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.offer.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.offer.section'))->schema([
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

                Forms\Components\Select::make('category')
                    ->label(__('admin_panel.common.category'))
                    ->options(OfferCategory::class)
                    ->required(),

                Forms\Components\Select::make('offered_by')
                    ->label(__('admin_panel.common.offered_by'))
                    ->relationship('offeredBy', 'full_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('service_address')
                    ->label(__('admin_panel.common.service_address')),

                Forms\Components\TextInput::make('contact_phone')
                    ->label(__('admin_panel.common.contact_phone'))
                    ->maxLength(20),

                Forms\Components\TextInput::make('contact_whatsapp')
                    ->label(__('admin_panel.common.whatsapp'))
                    ->maxLength(20),

                Forms\Components\DateTimePicker::make('expires_at')
                    ->label(__('admin_panel.common.expires_at')),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->default(true),

                Forms\Components\SpatieMediaLibraryFileUpload::make('offer_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('offer_image')
                    ->image(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                    ->label(__('admin_panel.common.gallery'))
                    ->collection('gallery')
                    ->multiple()
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('offer_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('offer_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category')
                    ->label(__('admin_panel.common.category'))
                    ->formatStateUsing(fn (OfferCategory $state): string => $state->label())
                    ->badge(),
                Tables\Columns\TextColumn::make('offeredBy.full_name')
                    ->label(__('admin_panel.common.offered_by')),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->label(__('admin_panel.common.expires_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(OfferCategory::class),
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
