<?php

namespace App\Filament\Resources\FamilyFundTransactionResource\Pages;

use App\Filament\Resources\FamilyFundTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFamilyFundTransactions extends ListRecords
{
    protected static string $resource = FamilyFundTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
