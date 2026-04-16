<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'إدارة الأعضاء';
    protected static ?string $modelLabel = 'عضو';
    protected static ?string $pluralModelLabel = 'الأعضاء';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('البيانات الأساسية')->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('الاسم الكامل')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->label('رقم الجوال')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),

                Forms\Components\TextInput::make('national_id')
                    ->label('رقم الهوية')
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),

                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation) => $operation === 'create'),

                Forms\Components\Select::make('gender')
                    ->label('الجنس')
                    ->options(Gender::class)
                    ->required(),

                Forms\Components\Select::make('role')
                    ->label('الصلاحية')
                    ->options(UserRole::class)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options(UserStatus::class)
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('بيانات إضافية')->schema([
                Forms\Components\Select::make('family_id')
                    ->label('العائلة')
                    ->relationship('family', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Forms\Components\TextInput::make('pending_family_name')
                    ->label('طلب عائلة (قيد المراجعة)')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn ($record) => $record instanceof User && filled($record->pending_family_name)),

                Forms\Components\TextInput::make('workplace')
                    ->label('جهة العمل')
                    ->maxLength(255),

                Forms\Components\TextInput::make('current_job')
                    ->label('العمل الحالي')
                    ->maxLength(255),

                Forms\Components\TextInput::make('city')
                    ->label('المدينة')
                    ->maxLength(100),

                Forms\Components\TextInput::make('region')
                    ->label('المنطقة')
                    ->maxLength(100),

                Forms\Components\Textarea::make('bio')
                    ->label('نبذة')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_featured')
                    ->label('عضو مميز'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('profile_image')
                    ->label('صورة الملف الشخصي')
                    ->collection('profile_image')
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('profile_image')
                    ->label('الصورة')
                    ->collection('profile_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('الجوال')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('الجنس')
                    ->badge(),
                Tables\Columns\TextColumn::make('role')
                    ->label('الصلاحية')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (UserStatus $state) => match ($state) {
                        UserStatus::Active => 'success',
                        UserStatus::Pending => 'warning',
                        UserStatus::Rejected => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التسجيل')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(UserStatus::class),
                Tables\Filters\SelectFilter::make('role')
                    ->options(UserRole::class),
                Tables\Filters\SelectFilter::make('gender')
                    ->options(Gender::class),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('مميز'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
