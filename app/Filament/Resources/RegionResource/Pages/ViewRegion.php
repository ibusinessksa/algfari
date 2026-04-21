<?php

namespace App\Filament\Resources\RegionResource\Pages;

use App\Filament\Resources\RegionResource;
use App\Models\Region;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRegion extends ViewRecord
{
    protected static string $resource = RegionResource::class;

    public function getTitle(): string
    {
        /** @var Region $record */
        $record = $this->getRecord();
        $name = $record->getTranslation('name', app()->getLocale())
            ?: $record->getTranslation('name', config('app.fallback_locale'));

        return __('admin_panel.region.view_title', ['name' => $name]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
