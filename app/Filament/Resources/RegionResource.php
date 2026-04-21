<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers\CitiesRelationManager;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    use Translatable;

    protected static ?string $model = Region::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?int $navigationSort = 11;

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.locations');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.region.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.region.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.region.section'))->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin_panel.common.name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('country_id')
                    ->label(__('admin_panel.common.country'))
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ])->columns(2),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__('admin_panel.region.section'))
                    ->schema([
                        Infolists\Components\TextEntry::make('name_ar')
                            ->label(__('admin_panel.tabs.arabic'))
                            ->state(fn (Region $record): string => (string) $record->getTranslation('name', 'ar')),
                        Infolists\Components\TextEntry::make('name_en')
                            ->label(__('admin_panel.tabs.english'))
                            ->state(fn (Region $record): string => (string) $record->getTranslation('name', 'en')),
                        Infolists\Components\TextEntry::make('country_display')
                            ->label(__('admin_panel.common.country'))
                            ->state(function (Region $record): string {
                                if (! $record->country) {
                                    return '—';
                                }

                                return (string) $record->country->getTranslation('name', app()->getLocale())
                                    ?: (string) $record->country->getTranslation('name', config('app.fallback_locale'));
                            }),
                        Infolists\Components\TextEntry::make('cities_count')
                            ->label(__('admin_panel.region.cities_count'))
                            ->state(fn (Region $record): int => $record->cities()->count()),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin_panel.common.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->label(__('admin_panel.common.country'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('cities_count')
                    ->label(__('admin_panel.region.cities_count'))
                    ->counts('cities')
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->filters([
                Tables\Filters\SelectFilter::make('country_id')
                    ->label(__('admin_panel.common.country'))
                    ->relationship('country', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label(__('admin_panel.common.details')),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'view' => Pages\ViewRegion::route('/{record}'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}
