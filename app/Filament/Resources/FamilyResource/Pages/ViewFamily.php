<?php

namespace App\Filament\Resources\FamilyResource\Pages;

use App\Filament\Resources\FamilyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFamily extends ViewRecord
{
    protected static string $resource = FamilyResource::class;

    public function getTitle(): string
    {
        return __('admin_panel.family.view_title', ['name' => $this->getRecord()->name]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
