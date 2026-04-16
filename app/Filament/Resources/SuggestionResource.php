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
    protected static ?string $navigationGroup = 'التواصل';
    protected static ?string $modelLabel = 'مقترح';
    protected static ?string $pluralModelLabel = 'المقترحات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات المقترح')->schema([
                Forms\Components\Tabs::make('translations')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('العربية')
                            ->schema([
                                Forms\Components\TextInput::make('title.ar')
                                    ->label('العنوان')
                                    ->required(),
                                Forms\Components\Textarea::make('description.ar')
                                    ->label('الوصف')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->label('Title')
                                    ->required(),
                                Forms\Components\Textarea::make('description.en')
                                    ->label('Description')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Select::make('submitted_by')
                    ->label('مقدم المقترح')
                    ->relationship('submitter', 'full_name')
                    ->searchable()
                    ->preload()
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options(SuggestionStatus::class),

                Forms\Components\Textarea::make('admin_response')
                    ->label('رد الإدارة')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('submitter.full_name')
                    ->label('المقدم'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (SuggestionStatus $state) => match ($state) {
                        SuggestionStatus::Pending => 'warning',
                        SuggestionStatus::Reviewed => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
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
                    ->label('مراجعة')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('admin_response')
                            ->label('رد الإدارة')
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
