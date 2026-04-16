<?php

namespace App\Filament\Resources;

use App\Enums\JoinRequestStatus;
use App\Filament\Resources\JoinRequestResource\Pages;
use App\Models\JoinRequest;
use App\Models\User;
use App\Notifications\JoinRequestRejected;
use App\Services\JoinRequestService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JoinRequestResource extends Resource
{
    protected static ?string $model = JoinRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'إدارة الأعضاء';
    protected static ?string $modelLabel = 'طلب انضمام';
    protected static ?string $pluralModelLabel = 'طلبات الانضمام';

    public static function getNavigationBadge(): ?string
    {
        return (string) JoinRequest::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات الطلب')->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('الاسم الكامل')
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('رقم الجوال')
                    ->required(),
                Forms\Components\TextInput::make('national_id')
                    ->label('رقم الهوية'),
                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني'),
                Forms\Components\TextInput::make('pending_family_name')
                    ->label('اسم العائلة (قيد المراجعة)')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label('المدينة'),
                Forms\Components\TextInput::make('region')
                    ->label('المنطقة'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options(JoinRequestStatus::class)
                    ->disabled(),
                Forms\Components\Textarea::make('rejection_reason')
                    ->label('سبب الرفض')
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('pending_family_name')
                    ->label('العائلة المطلوبة')
                    ->toggleable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('city')
                    ->label('المدينة')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (JoinRequestStatus $state) => match ($state) {
                        JoinRequestStatus::Pending => 'warning',
                        JoinRequestStatus::Approved => 'success',
                        JoinRequestStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الطلب')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(JoinRequestStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('قبول')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (JoinRequest $record) {
                        app(JoinRequestService::class)->approve($record, (int) auth()->id());

                        FilamentNotification::make()
                            ->title('تم قبول الطلب وإنشاء حساب العضو')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (JoinRequest $record) => $record->status === JoinRequestStatus::Pending),

                Tables\Actions\Action::make('reject')
                    ->label('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('سبب الرفض')
                            ->required(),
                    ])
                    ->action(function (JoinRequest $record, array $data) {
                        $record->update([
                            'status' => JoinRequestStatus::Rejected,
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                            'rejection_reason' => $data['rejection_reason'],
                        ]);

                        // Notify user if they already have an account
                        if ($record->user) {
                            $record->user->notify(new JoinRequestRejected($data['rejection_reason']));
                        }

                        FilamentNotification::make()
                            ->title('تم رفض الطلب')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (JoinRequest $record) => $record->status === JoinRequestStatus::Pending),

                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJoinRequests::route('/'),
        ];
    }
}
