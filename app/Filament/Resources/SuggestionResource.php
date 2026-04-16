<?php

namespace App\Filament\Resources;

use App\Enums\SuggestionStatus;
use App\Filament\Resources\SuggestionResource\Pages;
use App\Models\Suggestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SuggestionResource extends Resource
{
    protected static ?string $model = Suggestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.communication');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.suggestion.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.suggestion.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.suggestion.section'))->schema([
                Forms\Components\Tabs::make('translations')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))
                            ->schema([
                                Forms\Components\TextInput::make('title.ar')
                                    ->label(__('admin_panel.common.title'))
                                    ->required(),
                                Forms\Components\Textarea::make('description.ar')
                                    ->label(__('admin_panel.common.description'))
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->label(__('admin_panel.common.title'))
                                    ->required(),
                                Forms\Components\Textarea::make('description.en')
                                    ->label(__('admin_panel.common.description'))
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Select::make('submitted_by')
                    ->label(__('admin_panel.suggestion.submitted_by'))
                    ->relationship('submitter', 'full_name')
                    ->searchable()
                    ->preload()
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(SuggestionStatus::class),

                Forms\Components\Textarea::make('admin_response')
                    ->label(__('admin_panel.common.admin_response'))
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin_panel.common.title'))
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('submitter.full_name')
                    ->label(__('admin_panel.common.submitter')),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (SuggestionStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (SuggestionStatus $state) => match ($state) {
                        SuggestionStatus::Pending => 'warning',
                        SuggestionStatus::Reviewed => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(SuggestionStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('review')
                    ->label(__('admin_panel.suggestion.review'))
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('admin_response')
                            ->label(__('admin_panel.common.admin_response'))
                            ->required(),
                    ])
                    ->action(function (Suggestion $record, array $data) {
                        $record->update([
                            'admin_response' => $data['admin_response'],
                            'status' => SuggestionStatus::Reviewed,
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);
                    })
                    ->visible(fn (Suggestion $record) => $record->status === SuggestionStatus::Pending),
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuggestions::route('/'),
        ];
    }
}
