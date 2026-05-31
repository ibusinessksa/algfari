<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.faq.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.faq.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.faq.section'))
                ->schema([
                    Forms\Components\Tabs::make('translations')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))
                                ->schema([
                                    Forms\Components\TextInput::make('question.ar')
                                        ->label(__('admin_panel.faq.question'))
                                        ->required()
                                        ->maxLength(500),
                                    Forms\Components\Textarea::make('answer.ar')
                                        ->label(__('admin_panel.faq.answer'))
                                        ->required()
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ]),
                            Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))
                                ->schema([
                                    Forms\Components\TextInput::make('question.en')
                                        ->label(__('admin_panel.faq.question'))
                                        ->maxLength(500),
                                    Forms\Components\Textarea::make('answer.en')
                                        ->label(__('admin_panel.faq.answer'))
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_active')
                        ->label(__('admin_panel.common.active'))
                        ->default(true),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label(__('admin_panel.faq.question'))
                    ->searchable()
                    ->limit(60),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('admin_panel.common.active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'asc')
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
