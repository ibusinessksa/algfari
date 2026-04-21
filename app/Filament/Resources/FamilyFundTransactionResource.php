<?php

namespace App\Filament\Resources;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Filament\Resources\FamilyFundTransactionResource\Pages;
use App\Models\FamilyFundTransaction;
use App\Notifications\FamilyFundTransactionReviewed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FamilyFundTransactionResource extends Resource
{
    protected static ?string $model = FamilyFundTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.finance');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.family_fund.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.family_fund.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.family_fund.section'))->schema([
                Forms\Components\Select::make('contributor_id')
                    ->label(__('admin_panel.family_fund.contributor'))
                    ->relationship('contributor', 'full_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label(__('admin_panel.common.amount'))
                    ->numeric()
                    ->required()
                    ->prefix(__('admin_panel.common.currency_sar')),

                Forms\Components\Select::make('transaction_type')
                    ->label(__('admin_panel.family_fund.transaction_type'))
                    ->options(TransactionType::class)
                    ->required(),

                Forms\Components\Tabs::make('translations')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))
                            ->schema([
                                Forms\Components\Textarea::make('description.ar')
                                    ->label(__('admin_panel.common.description'))
                                    ->rows(3),
                            ]),
                        Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))
                            ->schema([
                                Forms\Components\Textarea::make('description.en')
                                    ->label(__('admin_panel.common.description'))
                                    ->rows(3),
                            ]),
                    ])
                    ->columnSpanFull(),

                Forms\Components\Select::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->options(TransactionStatus::class)
                    ->required()
                    ->default('pending'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('receipt')
                    ->label(__('admin_panel.common.receipt'))
                    ->collection('receipt'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contributor.full_name')
                    ->label(__('admin_panel.family_fund.contributor'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('admin_panel.common.amount'))
                    ->money('SAR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_type')
                    ->label(__('admin_panel.common.type'))
                    ->formatStateUsing(fn (TransactionType $state): string => $state->label())
                    ->badge()
                    ->color(fn (TransactionType $state) => match ($state) {
                        TransactionType::Donation => 'success',
                        TransactionType::Expense => 'danger',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (TransactionStatus $state): string => $state->label())
                    ->badge()
                    ->color(fn (TransactionStatus $state) => match ($state) {
                        TransactionStatus::Pending => 'warning',
                        TransactionStatus::Approved => 'success',
                        TransactionStatus::Rejected => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.date'))
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
                    ->label(__('admin_panel.family_fund.approve'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (FamilyFundTransaction $record) {
                        $record->update([
                            'status' => TransactionStatus::Approved,
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                        ]);
                        $record->load('contributor');
                        $record->contributor?->notify(new FamilyFundTransactionReviewed($record->fresh(), approved: true));
                    })
                    ->visible(fn (FamilyFundTransaction $record) => $record->status === TransactionStatus::Pending),
                Tables\Actions\Action::make('reject')
                    ->label(__('admin_panel.family_fund.reject'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (FamilyFundTransaction $record) {
                        $record->update([
                            'status' => TransactionStatus::Rejected,
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                        ]);
                        $record->load('contributor');
                        $record->contributor?->notify(new FamilyFundTransactionReviewed($record->fresh(), approved: false));
                    })
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
