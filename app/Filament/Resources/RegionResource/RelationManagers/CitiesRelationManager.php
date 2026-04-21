<?php

namespace App\Filament\Resources\RegionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'cities';

    public static function getTitle($ownerRecord, string $pageClass): string
    {
        return __('admin_panel.city.plural');
    }

    public function isReadOnly(): bool
    {
        return is_a($this->getPageClass(), ViewRecord::class, true);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label(__('admin_panel.common.name'))
                ->required()
                ->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin_panel.common.name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
