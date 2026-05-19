<?php

namespace App\Filament\Resources\SuggestionResource\Pages;

use App\Enums\SuggestionStatus;
use App\Filament\Resources\SuggestionResource;
use App\Notifications\SuggestionStatusUpdated;
use Filament\Resources\Pages\EditRecord;

class EditSuggestion extends EditRecord
{
    protected static string $resource = SuggestionResource::class;

    private ?SuggestionStatus $originalStatus = null;

    protected function beforeSave(): void
    {
        $this->originalStatus = $this->record->getOriginal('status') instanceof SuggestionStatus
            ? $this->record->getOriginal('status')
            : ($this->record->getOriginal('status')
                ? SuggestionStatus::from($this->record->getOriginal('status'))
                : null);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['reviewed_by'] = auth()->id();
        $data['reviewed_at'] = now();

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->originalStatus !== $this->record->status && $this->record->submitter) {
            $this->record->submitter->notify(new SuggestionStatusUpdated($this->record->fresh()));
        }
    }
}
