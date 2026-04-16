<?php

namespace App\Filament\Resources\FamilyFundTransactionResource\Pages;

use App\Filament\Resources\FamilyFundTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFamilyFundTransaction extends EditRecord
{
    protected static string $resource = FamilyFundTransactionResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['description'] = array_merge(
            ['ar' => '', 'en' => ''],
            $this->record->getTranslations('description')
        );

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
