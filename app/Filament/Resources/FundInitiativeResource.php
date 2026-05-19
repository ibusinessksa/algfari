<?php

namespace App\Filament\Resources;

use App\Enums\FundInitiativeStatus;
use App\Filament\Resources\FundInitiativeResource\Pages;
use App\Models\FundInitiative;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FundInitiativeResource extends Resource
{
    protected static ?string $model = FundInitiative::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.finance');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.fund_initiative.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.fund_initiative.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.fund_initiative.section'))->schema([
                Forms\Components\Tabs::make('translations')->tabs([
                    Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))->schema([
                        Forms\Components\TextInput::make('title.ar')
                            ->label(__('admin_panel.common.title'))->required(),
                        Forms\Components\Textarea::make('description.ar')
                            ->label(__('admin_panel.common.description'))
                            ->rows(4)->columnSpanFull(),
                    ]),
                    Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->label(__('admin_panel.common.title'))->required(),
                        Forms\Components\Textarea::make('description.en')
                            ->label(__('admin_panel.common.description'))
                            ->rows(4)->columnSpanFull(),
                    ]),
                ])->columnSpanFull(),

                Forms\Components\TextInput::make('target_amount')
                    ->label(__('admin_panel.fund_initiative.target_amount'))
                    ->numeric()->prefix('SAR'),
                Forms\Components\TextInput::make('raised_amount')
                    ->label(__('admin_panel.fund_initiative.raised_amount'))
                    ->numeric()->prefix('SAR')->default(0),

                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(FundInitiativeStatus::class)
                    ->default(FundInitiativeStatus::Active->value)
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->default(true),

                Forms\Components\DatePicker::make('start_date')
                    ->label(__('admin_panel.common.start_date')),
                Forms\Components\DatePicker::make('end_date')
                    ->label(__('admin_panel.common.end_date')),

                SpatieMediaLibraryFileUpload::make('cover_image')
                    ->label(__('admin_panel.common.cover_image'))
                    ->collection('cover_image')
                    ->image()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('cover_image'),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->searchable()->limit(40),
                Tables\Columns\TextColumn::make('target_amount')
                    ->label(__('admin_panel.fund_initiative.target_amount'))
                    ->money('SAR'),
                Tables\Columns\TextColumn::make('raised_amount')
                    ->label(__('admin_panel.fund_initiative.raised_amount'))
                    ->money('SAR'),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (FundInitiativeStatus $state) => $state->label())
                    ->badge()
                    ->color(fn (FundInitiativeStatus $state) => $state->color()),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->boolean(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(FundInitiativeStatus::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFundInitiatives::route('/'),
            'create' => Pages\CreateFundInitiative::route('/create'),
            'edit' => Pages\EditFundInitiative::route('/{record}/edit'),
        ];
    }
}
