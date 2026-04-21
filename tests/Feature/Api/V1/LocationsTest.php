<?php

namespace Tests\Feature\Api\V1;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_regions_index_returns_paginated_data(): void
    {
        $country = Country::create([
            'name' => ['ar' => 'دولة', 'en' => 'Country'],
            'code' => 'C1',
        ]);
        Region::create([
            'country_id' => $country->id,
            'name' => ['ar' => 'منطقة الشمال', 'en' => 'North'],
        ]);

        $response = $this->getJson('/api/v1/regions');

        $response->assertOk()
            ->assertJsonStructure(['data', 'links', 'meta']);

        $this->assertGreaterThanOrEqual(1, count($response->json('data')));
        $first = $response->json('data.0');
        $this->assertArrayHasKey('name', $first);
        $this->assertEquals('منطقة الشمال', $first['name']['ar']);
        $this->assertArrayHasKey('cities_count', $first);
        $this->assertArrayHasKey('country', $first);
    }

    public function test_regions_can_filter_by_country_id(): void
    {
        $c1 = Country::create(['name' => ['ar' => 'أ', 'en' => 'A'], 'code' => 'A1']);
        $c2 = Country::create(['name' => ['ar' => 'ب', 'en' => 'B'], 'code' => 'B1']);
        Region::create(['country_id' => $c1->id, 'name' => ['ar' => 'ر1', 'en' => 'R1']]);
        Region::create(['country_id' => $c2->id, 'name' => ['ar' => 'ر2', 'en' => 'R2']]);

        $response = $this->getJson('/api/v1/regions?country_id='.$c1->id);

        $response->assertOk();
        $ids = collect($response->json('data'))->pluck('id');
        $this->assertTrue($ids->every(fn (int $id) => Region::find($id)->country_id === $c1->id));
    }

    public function test_cities_index_returns_region_and_country(): void
    {
        $country = Country::create([
            'name' => ['ar' => 'السعودية', 'en' => 'KSA'],
            'code' => 'SA',
        ]);
        $region = Region::create([
            'country_id' => $country->id,
            'name' => ['ar' => 'الرياض', 'en' => 'Riyadh'],
        ]);
        City::create([
            'region_id' => $region->id,
            'name' => ['ar' => 'مدينة الرياض', 'en' => 'Riyadh City'],
        ]);

        $response = $this->getJson('/api/v1/cities?region_id='.$region->id);

        $response->assertOk();
        $first = $response->json('data.0');
        $this->assertEquals($region->id, $first['region_id']);
        $this->assertArrayHasKey('region', $first);
        $this->assertEquals($country->id, $first['region']['country']['id']);
        $this->assertEquals('SA', $first['region']['country']['code']);
    }

    public function test_cities_can_filter_by_country_id(): void
    {
        $c1 = Country::create(['name' => ['ar' => 'أ', 'en' => 'A'], 'code' => 'X1']);
        $c2 = Country::create(['name' => ['ar' => 'ب', 'en' => 'B'], 'code' => 'X2']);
        $r1 = Region::create(['country_id' => $c1->id, 'name' => ['ar' => 'من1', 'en' => 'M1']]);
        $r2 = Region::create(['country_id' => $c2->id, 'name' => ['ar' => 'من2', 'en' => 'M2']]);
        City::create(['region_id' => $r1->id, 'name' => ['ar' => 'مدينة أ', 'en' => 'City A']]);
        City::create(['region_id' => $r2->id, 'name' => ['ar' => 'مدينة ب', 'en' => 'City B']]);

        $response = $this->getJson('/api/v1/cities?country_id='.$c1->id);

        $response->assertOk();
        foreach ($response->json('data') as $row) {
            $this->assertEquals($c1->id, $row['region']['country_id']);
        }
    }
}
