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

    protected static ?string $navigationGroup = 'إدارة الأعضاء';

    protected static ?string $modelLabel = 'عائلة';

    protected static ?string $pluralModelLabel = 'العائلات';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات العائلة')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('اسم العائلة')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('origin')
                    ->label('الأصل / النسب')
                    ->maxLength(255)
                    ->placeholder('مثال: أهل الرس'),
            ])->columns(2),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('بيانات العائلة')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('اسم العائلة'),
                        Infolists\Components\TextEntry::make('origin')
                            ->label('الأصل / النسب')
                            ->placeholder('—'),
                        Infolists\Components\TextEntry::make('members_count')
                            ->label('عدد الأعضاء')
                            ->state(fn (Family $record): int => $record->members()->count()),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('تاريخ الإنشاء')
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
                    ->label('اسم العائلة')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('origin')
                    ->label('الأصل')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('members_count')
                    ->label('عدد الأعضاء')
                    ->counts('members')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
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
                    ->label('التفاصيل'),
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
