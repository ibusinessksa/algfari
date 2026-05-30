<?php

namespace App\Models\Concerns;

/**
 * Adds a virtual `location` attribute backed by the `location_lat` /
 * `location_lng` columns, so the cheesegrits Filament Map field (which works
 * with a single ['lat' => ..., 'lng' => ...] array) can read and persist
 * coordinates directly.
 *
 * This is the single source of truth for saving map coordinates: the Map field's
 * dehydrated `location` state is always sent on form submit, so the marker's
 * latest position persists whether it was set by dragging, clicking, selecting
 * from the autocomplete search field, or using "my location" geolocation.
 *
 * @property float|null $location_lat
 * @property float|null $location_lng
 */
trait HasMapLocation
{
    /**
     * Allow the virtual `location` attribute to be mass-assigned so the mutator
     * below runs when Filament fills the model on create/update.
     */
    public function initializeHasMapLocation(): void
    {
        $this->mergeFillable(['location']);
    }

    /**
     * @return array{lat: float|null, lng: float|null}
     */
    public function getLocationAttribute(): array
    {
        return [
            'lat' => $this->location_lat !== null ? (float) $this->location_lat : null,
            'lng' => $this->location_lng !== null ? (float) $this->location_lng : null,
        ];
    }

    /**
     * @param  array{lat?: mixed, lng?: mixed}|null  $value
     */
    public function setLocationAttribute(?array $value): void
    {
        if (! is_array($value)) {
            return;
        }

        if (array_key_exists('lat', $value)) {
            $this->attributes['location_lat'] = $value['lat'];
        }

        if (array_key_exists('lng', $value)) {
            $this->attributes['location_lng'] = $value['lng'];
        }
    }
}
