<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Filament\Resources\UserResource\Pages;
use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.members');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.user.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.user.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.common.basic_info'))->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label(__('admin_panel.common.full_name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->label(__('admin_panel.common.phone'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),

                Forms\Components\TextInput::make('national_id')
                    ->label(__('admin_panel.common.national_id'))
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),

                Forms\Components\TextInput::make('email')
                    ->label(__('admin_panel.common.email'))
                    ->email()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->label(__('admin_panel.common.password'))
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation) => $operation === 'create'),

                Forms\Components\Select::make('gender')
                    ->label(__('admin_panel.common.gender'))
                    ->options(Gender::class)
                    ->required(),

                Forms\Components\Select::make('role')
                    ->label(__('admin_panel.common.role'))
                    ->options(UserRole::class)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(UserStatus::class)
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make(__('admin_panel.common.extra_info'))->schema([
                Forms\Components\Select::make('family_id')
                    ->label(__('admin_panel.common.family'))
                    ->relationship('family', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Forms\Components\TextInput::make('pending_family_name')
                    ->label(__('admin_panel.common.pending_family_name_field'))
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn ($record) => $record instanceof User && filled($record->pending_family_name)),

                Forms\Components\TextInput::make('workplace')
                    ->label(__('admin_panel.common.workplace'))
                    ->maxLength(255),

                Forms\Components\TextInput::make('current_job')
                    ->label(__('admin_panel.common.current_job'))
                    ->maxLength(255),

                Forms\Components\TextInput::make('job_title')
                    ->label(__('admin_panel.common.job_title'))
                    ->maxLength(255),

                Forms\Components\Select::make('region_id')
                    ->label(__('admin_panel.common.region'))
                    ->options(fn (): array => Region::query()
                        ->orderBy('name->'.self::formLocale())
                        ->get()
                        ->mapWithKeys(fn (Region $region): array => [
                            $region->id => $region->getTranslation('name', self::formLocale())
                                ?: $region->getTranslation('name', 'ar'),
                        ])
                        ->all())
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('city_id', null))
                    ->default(fn ($record) => $record?->region_id ?? $record?->city?->region_id),

                Forms\Components\Select::make('city_id')
                    ->label(__('admin_panel.common.city'))
                    ->options(fn (Get $get) => $get('region_id')
                        ? City::where('region_id', $get('region_id'))->pluck('name', 'id')
                        : City::all()->pluck('name', 'id'))
                    ->searchable()
                    ->preload(),

                Forms\Components\Textarea::make('bio')
                    ->label(__('admin_panel.common.bio'))
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_featured')
                    ->label(__('admin_panel.user.featured_member')),

                Forms\Components\SpatieMediaLibraryFileUpload::make('profile_image')
                    ->label(__('admin_panel.common.profile_image'))
                    ->collection('profile_image')
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make(__('admin_panel.common.basic_info'))
                ->schema([
                    Infolists\Components\SpatieMediaLibraryImageEntry::make('profile_image')
                        ->label(__('admin_panel.common.profile_image'))
                        ->collection('profile_image')
                        ->circular(),
                    Infolists\Components\TextEntry::make('full_name')
                        ->label(__('admin_panel.common.full_name')),
                    Infolists\Components\TextEntry::make('phone_number')
                        ->label(__('admin_panel.common.phone'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('email')
                        ->label(__('admin_panel.common.email'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('national_id')
                        ->label(__('admin_panel.common.national_id'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('gender')
                        ->label(__('admin_panel.common.gender'))
                        ->formatStateUsing(fn (Gender $state): string => $state->label())
                        ->badge(),
                    Infolists\Components\TextEntry::make('role')
                        ->label(__('admin_panel.common.role'))
                        ->formatStateUsing(fn (UserRole $state): string => $state->label())
                        ->badge(),
                    Infolists\Components\TextEntry::make('status')
                        ->label(__('admin_panel.common.status'))
                        ->formatStateUsing(fn (UserStatus $state): string => $state->label())
                        ->badge()
                        ->color(fn (UserStatus $state) => match ($state) {
                            UserStatus::Active => 'success',
                            UserStatus::Pending => 'warning',
                            UserStatus::Rejected => 'danger',
                        }),
                ])->columns(2),

            Infolists\Components\Section::make(__('admin_panel.common.extra_info'))
                ->schema([
                    Infolists\Components\TextEntry::make('family.name')
                        ->label(__('admin_panel.common.family'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('pending_family_name')
                        ->label(__('admin_panel.common.pending_family_name_field'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('workplace')
                        ->label(__('admin_panel.common.workplace'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('current_job')
                        ->label(__('admin_panel.common.current_job'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('job_title')
                        ->label(__('admin_panel.common.job_title'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('region.name')
                        ->label(__('admin_panel.common.region'))
                        ->state(fn ($record) => $record->region?->getTranslation('name', self::formLocale())
                            ?: $record->region?->getTranslation('name', 'ar'))
                        ->placeholder('—'),
                    Infolists\Components\TextEntry::make('city.name')
                        ->label(__('admin_panel.common.city'))
                        ->placeholder('—'),
                    Infolists\Components\IconEntry::make('is_featured')
                        ->label(__('admin_panel.user.featured_member'))
                        ->boolean(),
                    Infolists\Components\TextEntry::make('bio')
                        ->label(__('admin_panel.common.bio'))
                        ->placeholder('—')
                        ->columnSpanFull(),
                    Infolists\Components\TextEntry::make('created_at')
                        ->label(__('admin_panel.common.registration_date'))
                        ->dateTime(),
                ])->columns(2),

            Infolists\Components\Section::make(__('admin_panel.user.children_section'))
                ->schema([
                    Infolists\Components\RepeatableEntry::make('children')
                        ->hiddenLabel()
                        ->schema([
                            Infolists\Components\TextEntry::make('display_name')
                                ->label(__('admin_panel.user.child_name'))
                                ->state(fn ($record) => $record->displayName()),
                            Infolists\Components\TextEntry::make('gender')
                                ->label(__('admin_panel.user.child_gender'))
                                ->badge(),
                            Infolists\Components\TextEntry::make('birthday')
                                ->label(__('admin_panel.user.child_birthday'))
                                ->date()
                                ->placeholder('—'),
                            Infolists\Components\TextEntry::make('linkedUser.full_name')
                                ->label(__('admin_panel.user.child_linked_member'))
                                ->placeholder('—'),
                        ])
                        ->columns(4)
                        ->placeholder(__('admin_panel.user.no_children')),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('profile_image')
                    ->label(__('admin_panel.common.image'))
                    ->collection('profile_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('admin_panel.common.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('admin_panel.common.mobile'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('admin_panel.common.gender'))
                    ->formatStateUsing(fn (Gender $state): string => $state->label())
                    ->badge(),
                Tables\Columns\TextColumn::make('role')
                    ->label(__('admin_panel.common.role'))
                    ->formatStateUsing(fn (UserRole $state): string => $state->label())
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (UserStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (UserStatus $state) => match ($state) {
                        UserStatus::Active => 'success',
                        UserStatus::Pending => 'warning',
                        UserStatus::Rejected => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('admin_panel.common.featured'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.registration_date'))
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
                    ->label(__('admin_panel.common.featured')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label(__('admin_panel.common.details')),
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
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    private static function formLocale(): string
    {
        $locale = app()->getLocale();

        return in_array($locale, ['ar', 'en'], true) ? $locale : 'ar';
    }
}
