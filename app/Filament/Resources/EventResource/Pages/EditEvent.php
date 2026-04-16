<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

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
