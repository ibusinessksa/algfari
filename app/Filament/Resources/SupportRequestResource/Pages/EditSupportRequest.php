<?php

namespace App\Filament\Resources\SupportRequestResource\Pages;

use App\Filament\Resources\SupportRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSupportRequest extends EditRecord
{
    protected static string $resource = SupportRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! empty($data['status']) && $this->record->status?->value !== $data['status']) {
            $data['reviewed_by'] = auth()->id();
            $data['reviewed_at'] = now();
        }

        return $data;
    }
}
