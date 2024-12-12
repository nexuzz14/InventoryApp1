<?php

namespace Tests\Unit;

use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $locationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->locationService = new LocationService();
    }

    public function test_store_saves_new_location()
    {
        $data = ['name' => 'Lokasi Baru'];

        $result = $this->locationService->store($data);

        $this->assertDatabaseHas('locations', $data);
        $this->assertInstanceOf(Location::class, $result);
    }

    public function test_get_all_locations_returns_all_locations()
    {
        Location::factory()->count(3)->create();

        $locations = $this->locationService->getAllLocations();

        $this->assertCount(3, $locations);
    }

    public function test_update_location_updates_existing_location()
    {
        $location = Location::factory()->create(['name' => 'Lokasi Lama']);
        $data = ['name' => 'Lokasi Baru'];

        $result = $this->locationService->updateLocation(encrypt($location->id), $data);

        $this->assertTrue($result);
        $this->assertDatabaseHas('locations', ['id' => $location->id, 'name' => 'Lokasi Baru']);
    }

    public function test_delete_location_removes_location()
    {
        $location = Location::factory()->create();

        $result = $this->locationService->deleteLocation(encrypt($location->id));

        $this->assertTrue($result);
        $this->assertModelMissing($location);

    }
}
