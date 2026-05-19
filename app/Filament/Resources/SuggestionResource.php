<?php

namespace App\Filament\Resources;

use App\Enums\SuggestionStatus;
use App\Filament\Resources\SuggestionResource\Pages;
use App\Models\Suggestion;
use App\Notifications\SuggestionStatusUpdated;
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
                Forms\Components\TextInput::make('name')
                    ->label(__('admin_panel.common.name'))
                    ->disabled(),

                Forms\Components\TextInput::make('email')
                    ->label(__('admin_panel.common.email'))
                    ->disabled(),

                Forms\Components\Select::make('submitted_by')
                    ->label(__('admin_panel.suggestion.submitted_by'))
                    ->relationship('submitter', 'full_name')
                    ->searchable()
                    ->preload()
                    ->disabled(),

                Forms\Components\Textarea::make('suggestion')
                    ->label(__('admin_panel.suggestion.text'))
                    ->disabled()
                    ->columnSpanFull()
                    ->rows(5),

                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(SuggestionStatus::class)
                    ->required(),

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
                Tables\Columns\TextColumn::make('submitter.full_name')
                    ->label(__('admin_panel.common.submitter'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('suggestion')
                    ->label(__('admin_panel.suggestion.text'))
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (SuggestionStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (SuggestionStatus $state) => $state->color()),
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
                        Forms\Components\Select::make('status')
                            ->label(__('admin_panel.common.status'))
                            ->options(collect(SuggestionStatus::cases())
                                ->mapWithKeys(fn (SuggestionStatus $s) => [$s->value => $s->label()])
                                ->all())
                            ->required(),
                        Forms\Components\Textarea::make('admin_response')
                            ->label(__('admin_panel.common.admin_response'))
                            ->rows(4),
                    ])
                    ->fillForm(fn (Suggestion $record): array => [
                        'status' => $record->status?->value,
                        'admin_response' => $record->admin_response,
                    ])
                    ->action(function (Suggestion $record, array $data) {
                        $newStatus = SuggestionStatus::from($data['status']);
                        $statusChanged = $record->status !== $newStatus;

                        $record->update([
                            'status' => $newStatus,
                            'admin_response' => $data['admin_response'] ?? null,
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);

                        if ($statusChanged && $record->submitter) {
                            $record->submitter->notify(new SuggestionStatusUpdated($record->fresh()));
                        }
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuggestions::route('/'),
            'edit' => Pages\EditSuggestion::route('/{record}/edit'),
        ];
    }
}
