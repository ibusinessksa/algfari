<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers\RegionsRelationManager;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.locations');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.country.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.country.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.country.section'))->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin_panel.common.name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('code')
                    ->label(__('admin_panel.country.code'))
                    ->required()
                    ->maxLength(3)
                    ->unique(ignoreRecord: true),
            ])->columns(2),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__('admin_panel.country.section'))
                    ->schema([
                        Infolists\Components\TextEntry::make('name_ar')
                            ->label(__('admin_panel.tabs.arabic'))
                            ->state(fn (Country $record): string => (string) $record->getTranslation('name', 'ar')),
                        Infolists\Components\TextEntry::make('name_en')
                            ->label(__('admin_panel.tabs.english'))
                            ->state(fn (Country $record): string => (string) $record->getTranslation('name', 'en')),
                        Infolists\Components\TextEntry::make('code')
                            ->label(__('admin_panel.country.code')),
                        Infolists\Components\TextEntry::make('regions_count')
                            ->label(__('admin_panel.country.regions_count'))
                            ->state(fn (Country $record): int => $record->regions()->count()),
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
                Tables\Columns\TextColumn::make('code')
                    ->label(__('admin_panel.country.code'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('regions_count')
                    ->label(__('admin_panel.country.regions_count'))
                    ->counts('regions')
                    ->sortable(),
            ])
            ->defaultSort('name')
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
            RegionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'view' => Pages\ViewCountry::route('/{record}'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
