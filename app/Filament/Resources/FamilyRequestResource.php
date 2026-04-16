<?php

namespace App\Filament\Resources;

use App\Enums\FamilyRequestStatus;
use App\Filament\Resources\FamilyRequestResource\Pages;
use App\Models\Family;
use App\Models\FamilyRequest;
use App\Services\FamilyRequestService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyRequestResource extends Resource
{
    protected static ?string $model = FamilyRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'إدارة الأعضاء';

    protected static ?string $modelLabel = 'طلب عائلة';

    protected static ?string $pluralModelLabel = 'طلبات العائلات';

    protected static ?int $navigationSort = 6;

    public static function getNavigationBadge(): ?string
    {
        return (string) FamilyRequest::query()
            ->where('status', FamilyRequestStatus::Pending)
            ->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->with('user'))
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('العضو')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.pending_family_name')
                    ->label('الاسم كما أدخله العضو')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('المفتاح المعياري للمطابقة')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (FamilyRequestStatus $state) => match ($state) {
                        FamilyRequestStatus::Pending => 'warning',
                        FamilyRequestStatus::Approved => 'success',
                        FamilyRequestStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الطلب')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(FamilyRequestStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve_link')
                    ->label('ربط بعائلة موجودة')
                    ->icon('heroicon-o-link')
                    ->color('success')
                    ->form([
                        Forms\Components\Select::make('family_id')
                            ->label('العائلة')
                            ->options(fn () => Family::query()->orderBy('name')->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (FamilyRequest $record, array $data) {
                        $family = Family::query()->findOrFail($data['family_id']);
                        app(FamilyRequestService::class)->approveLinkingToExisting(
                            $record,
                            $family,
                            (int) auth()->id()
                        );

                        FilamentNotification::make()
                            ->title('تم ربط العضو بالعائلة')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (FamilyRequest $record) => $record->status === FamilyRequestStatus::Pending),

                Tables\Actions\Action::make('approve_create')
                    ->label('إنشاء عائلة والربط')
                    ->icon('heroicon-o-plus-circle')
                    ->color('primary')
                    ->form([
                        Forms\Components\TextInput::make('family_name')
                            ->label('اسم العائلة المعتمد')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('family_origin')
                            ->label('الأصل / النسب')
                            ->maxLength(255),
                    ])
                    ->action(function (FamilyRequest $record, array $data) {
                        app(FamilyRequestService::class)->approveCreatingFamily(
                            $record,
                            $data['family_name'],
                            $data['family_origin'] ?? null,
                            (int) auth()->id()
                        );

                        FilamentNotification::make()
                            ->title('تم إنشاء العائلة وربط العضو')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (FamilyRequest $record) => $record->status === FamilyRequestStatus::Pending),

                Tables\Actions\Action::make('reject')
                    ->label('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('سبب الرفض')
                            ->required(),
                    ])
                    ->action(function (FamilyRequest $record, array $data) {
                        app(FamilyRequestService::class)->reject(
                            $record,
                            $data['rejection_reason'],
                            (int) auth()->id()
                        );

                        FilamentNotification::make()
                            ->title('تم رفض الطلب')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (FamilyRequest $record) => $record->status === FamilyRequestStatus::Pending),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilyRequests::route('/'),
        ];
    }
}
