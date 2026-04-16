<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['title'] = array_merge(
            ['ar' => '', 'en' => ''],
            $this->record->getTranslations('title')
        );
        $data['content'] = array_merge(
            ['ar' => '', 'en' => ''],
            $this->record->getTranslations('content')
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
