<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyResource\Pages;
use App\Filament\Resources\FamilyResource\RelationManagers\MembersRelationManager;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.members');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.family.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.family.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.family.section'))->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin_panel.family.family_name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('origin')
                    ->label(__('admin_panel.common.origin_lineage'))
                    ->maxLength(255)
                    ->placeholder(__('admin_panel.family.origin_placeholder')),
            ])->columns(2),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make(__('admin_panel.family.section'))
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label(__('admin_panel.family.family_name')),
                        Infolists\Components\TextEntry::make('origin')
                            ->label(__('admin_panel.common.origin_lineage'))
                            ->placeholder('—'),
                        Infolists\Components\TextEntry::make('members_count')
                            ->label(__('admin_panel.common.members_count'))
                            ->state(fn (Family $record): int => $record->members()->count()),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label(__('admin_panel.common.created_at'))
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin_panel.family.family_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('origin')
                    ->label(__('admin_panel.common.origin'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('members_count')
                    ->label(__('admin_panel.common.members_count'))
                    ->counts('members')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                //
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
            MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'view' => Pages\ViewFamily::route('/{record}'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
