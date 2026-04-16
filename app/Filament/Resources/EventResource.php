<?php

namespace App\Filament\Resources;

use App\Enums\EventType;
use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $modelLabel = 'مناسبة';
    protected static ?string $pluralModelLabel = 'المناسبات';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات المناسبة')->schema([
                Forms\Components\Tabs::make('translations')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('العربية')
                            ->schema([
                                Forms\Components\TextInput::make('title.ar')
                                    ->label('العنوان')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description.ar')
                                    ->label('الوصف')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\TextInput::make('title.en')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description.en')
                                    ->label('Description')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Select::make('event_type')
                    ->label('نوع المناسبة')
                    ->options(EventType::class)
                    ->required(),

                Forms\Components\DateTimePicker::make('event_date')
                    ->label('تاريخ البداية')
                    ->required(),

                Forms\Components\DateTimePicker::make('end_date')
                    ->label('تاريخ النهاية'),

                Forms\Components\TextInput::make('location_name')
                    ->label('اسم الموقع'),

                Forms\Components\TextInput::make('location_lat')
                    ->label('خط العرض')
                    ->numeric(),

                Forms\Components\TextInput::make('location_lng')
                    ->label('خط الطول')
                    ->numeric(),

                Forms\Components\Select::make('created_by')
                    ->label('المنشئ')
                    ->relationship('creator', 'full_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('فعال')
                    ->default(true),

                Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                    ->label('صورة الغلاف')
                    ->collection('cover_image')
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->label('الصورة')
                    ->collection('cover_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('event_type')
                    ->label('النوع')
                    ->badge(),
                Tables\Columns\TextColumn::make('event_date')
                    ->label('التاريخ')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('creator.full_name')
                    ->label('المنشئ'),
                Tables\Columns\TextColumn::make('attendees_count')
                    ->label('الحضور')
                    ->counts('attendees'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('فعال')
                    ->boolean(),
            ])
            ->defaultSort('event_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('event_type')
                    ->options(EventType::class),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('فعال'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
