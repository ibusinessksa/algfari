<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.news.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.news.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.news.section'))
                ->schema([
                    Forms\Components\Tabs::make('translations')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))
                                ->schema([
                                    Forms\Components\TextInput::make('title.ar')
                                        ->label(__('admin_panel.common.title'))
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.ar')
                                        ->label(__('admin_panel.common.content'))
                                        ->required()
                                        ->columnSpanFull(),
                                ]),
                            Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))
                                ->schema([
                                    Forms\Components\TextInput::make('title.en')
                                        ->label(__('admin_panel.common.title'))
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.en')
                                        ->label(__('admin_panel.common.content'))
                                        ->required()
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_urgent')
                        ->label(__('admin_panel.common.urgent')),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label(__('admin_panel.news.published_schedule'))
                        ->seconds(false),

                    Forms\Components\TimePicker::make('time_from')
                        ->label(__('admin_panel.news.time_from'))
                        ->seconds(false),

                    Forms\Components\TimePicker::make('time_to')
                        ->label(__('admin_panel.news.time_to'))
                        ->seconds(false),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                        ->label(__('admin_panel.common.cover_image'))
                        ->collection('cover_image')
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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('cover_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\IconColumn::make('is_urgent')
                    ->label(__('admin_panel.common.urgent'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('admin_panel.common.published_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_from')
                    ->label(__('admin_panel.common.from'))
                    ->time()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('time_to')
                    ->label(__('admin_panel.common.to'))
                    ->time()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_urgent')
                    ->label(__('admin_panel.common.urgent')),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
