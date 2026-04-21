<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use App\Models\Country;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCountry extends ViewRecord
{
    protected static string $resource = CountryResource::class;

    public function getTitle(): string
    {
        /** @var Country $record */
        $record = $this->getRecord();
        $name = $record->getTranslation('name', app()->getLocale())
            ?: $record->getTranslation('name', config('app.fallback_locale'));

        return __('admin_panel.country.view_title', ['name' => $name]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
