<?php

namespace App\Filament\Resources;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Filament\Resources\FamilyFundTransactionResource\Pages;
use App\Models\FamilyFundTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyFundTransactionResource extends Resource
{
    protected static ?string $model = FamilyFundTransaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'المالية';
    protected static ?string $modelLabel = 'معاملة مالية';
    protected static ?string $pluralModelLabel = 'صندوق العائلة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات المعاملة')->schema([
                Forms\Components\Select::make('contributor_id')
                    ->label('المساهم')
                    ->relationship('contributor', 'full_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('المبلغ')
                    ->numeric()
                    ->required()
                    ->prefix('ر.س'),

                Forms\Components\Select::make('transaction_type')
                    ->label('نوع المعاملة')
                    ->options(TransactionType::class)
                    ->required(),

                Forms\Components\Tabs::make('translations')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('العربية')
                            ->schema([
                                Forms\Components\Textarea::make('description.ar')
                                    ->label('الوصف')
                                    ->rows(3),
                            ]),
                        Forms\Components\Tabs\Tab::make('English')
                            ->schema([
                                Forms\Components\Textarea::make('description.en')
                                    ->label('Description')
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options(TransactionStatus::class)
                    ->required()
                    ->default('pending'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('receipt')
                    ->label('إيصال الدفع')
                    ->collection('receipt'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contributor.full_name')
                    ->label('المساهم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('المبلغ')
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_type')
                    ->label('النوع')
                    ->badge()
                    ->color(fn (TransactionType $state) => match ($state) {
                        TransactionType::Donation => 'success',
                        TransactionType::Expense => 'danger',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (TransactionStatus $state) => match ($state) {
                        TransactionStatus::Pending => 'warning',
                        TransactionStatus::Approved => 'success',
                        TransactionStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('transaction_type')
                    ->options(TransactionType::class),
                Tables\Filters\SelectFilter::make('status')
                    ->options(TransactionStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('اعتماد')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (FamilyFundTransaction $record) => $record->update([
                        'status' => TransactionStatus::Approved,
                        'approved_by' => auth()->id(),
                        'approved_at' => now(),
                    ]))
                    ->visible(fn (FamilyFundTransaction $record) => $record->status === TransactionStatus::Pending),
                Tables\Actions\Action::make('reject')
                    ->label('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (FamilyFundTransaction $record) => $record->update([
                        'status' => TransactionStatus::Rejected,
                        'approved_by' => auth()->id(),
                        'approved_at' => now(),
                    ]))
                    ->visible(fn (FamilyFundTransaction $record) => $record->status === TransactionStatus::Pending),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFamilyFundTransactions::route('/'),
            'create' => Pages\CreateFamilyFundTransaction::route('/create'),
            'edit' => Pages\EditFamilyFundTransaction::route('/{record}/edit'),
        ];
    }
}
