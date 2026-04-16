<?php

namespace App\Filament\Resources\OfferResource\Pages;

use App\Filament\Resources\OfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOffer extends EditRecord
{
    protected static string $resource = OfferResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['title'] = array_merge(
            ['ar' => '', 'en' => ''],
            $this->record->getTranslations('title')
        );
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
