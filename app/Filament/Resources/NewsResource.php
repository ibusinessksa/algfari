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
    protected static ?string $navigationGroup = 'المحتوى';
    protected static ?string $modelLabel = 'خبر';
    protected static ?string $pluralModelLabel = 'الأخبار';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات الخبر')
                ->schema([
                    Forms\Components\Tabs::make('translations')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make('العربية')
                                ->schema([
                                    Forms\Components\TextInput::make('title.ar')
                                        ->label('العنوان')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.ar')
                                        ->label('المحتوى')
                                        ->required()
                                        ->columnSpanFull(),
                                ]),
                            Forms\Components\Tabs\Tab::make('English')
                                ->schema([
                                    Forms\Components\TextInput::make('title.en')
                                        ->label('Title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content.en')
                                        ->label('Content')
                                        ->required()
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_urgent')
                        ->label('عاجل'),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('تاريخ ووقت النشر')
                        ->seconds(false),

                    Forms\Components\TimePicker::make('time_from')
                        ->label('الوقت من')
                        ->seconds(false),

                    Forms\Components\TimePicker::make('time_to')
                        ->label('الوقت إلى')
                        ->seconds(false),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                        ->label('صورة الغلاف')
                        ->collection('cover_image')
                        ->image(),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('معرض الصور')
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
                    ->label('الصورة')
                    ->collection('cover_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\IconColumn::make('is_urgent')
                    ->label('عاجل')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_from')
                    ->label('من')
                    ->time()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('time_to')
                    ->label('إلى')
                    ->time()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_urgent')
                    ->label('عاجل'),
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
