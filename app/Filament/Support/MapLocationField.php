<?php

namespace App\Filament\Support;

use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

/**
 * Reusable, fully-synchronized location picker for Filament forms.
 *
 * Renders an address autocomplete text field wired to a Google Map. Behaviour:
 *  - Selecting an address from the search field moves the map marker.
 *  - Dragging / clicking the marker (or using "my location") updates the
 *    coordinates and reverse-geocodes the address back into the search field.
 *  - On submit, the marker's latest position is saved to the lat/lng columns via
 *    the model's `location` mutator (see {@see \App\Models\Concerns\HasMapLocation}),
 *    regardless of how it was set.
 *  - On edit, the saved coordinates are loaded back onto the marker.
 *
 * The map's `location` state is the single source of truth, which avoids the
 * stale-coordinate bug that occurs when separate hidden lat/lng fields are
 * updated through the map's (non-live, deferred) `afterStateUpdated` hook.
 *
 * To reuse on another model, give that model the `HasMapLocation` trait with
 * matching `{$latColumn}` / `{$lngColumn}` columns, then drop
 * `...MapLocationField::make()` into the form schema.
 *
 * @return array<int, Component>
 */
class MapLocationField
{
    /**
     * @return array<int, Component>
     */
    public static function make(
        string $nameField = 'location_name',
        string $mapField = 'location',
        string $latColumn = 'location_lat',
        string $lngColumn = 'location_lng',
        int $defaultZoom = 12,
    ): array {
        return [
            TextInput::make($nameField)
                ->label(__('admin_panel.common.location_name'))
                ->maxLength(255)
                ->columnSpanFull(),

            Map::make($mapField)
                ->label(__('admin_panel.common.location'))
                // Selecting from the search field moves the marker.
                ->autocomplete($nameField)
                // Moving the marker updates the search field's address.
                ->autocompleteReverse(true)
                ->defaultZoom($defaultZoom)
                ->draggable()
                ->clickable()
                ->geolocate()
                ->geolocateLabel(__('admin_panel.common.use_my_location'))
                // Load the saved coordinates onto the marker when editing.
                ->afterStateHydrated(function (Map $component, ?Model $record) use ($latColumn, $lngColumn): void {
                    if (
                        $record
                        && $record->{$latColumn} !== null
                        && $record->{$lngColumn} !== null
                    ) {
                        $component->state([
                            'lat' => (float) $record->{$latColumn},
                            'lng' => (float) $record->{$lngColumn},
                        ]);
                    }
                })
                ->columnSpanFull(),
        ];
    }
}
