<?php

namespace App\Filament\Resources\FundInitiativeResource\Pages;

use App\Filament\Resources\FundInitiativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFundInitiatives extends ListRecords
{
    protected static string $resource = FundInitiativeResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
