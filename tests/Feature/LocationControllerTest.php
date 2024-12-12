<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_all_locations()
    {
        Location::factory()->count(5)->create();

        $response = $this->get(route('lokasi'));

        $response->assertStatus(200);
        $response->assertViewHas('data');
    }

    public function test_store_creates_new_location()
    {
        $data = [
            'name' => 'Lokasi Baru',
        ];

        $response = $this->post(route('location.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('locations', $data);
    }

    public function test_destroy_deletes_a_location()
    {
        $location = Location::factory()->create();

        $response = $this->delete(route('location.delete', $location->id));

        $response->assertRedirect();
        $this->assertModelMissing($location);

    }

    public function test_update_edits_existing_location()
    {
        $location = Location::factory()->create(['name' => 'Lokasi Lama']);

        $data = [
            'id' => encrypt($location->id),
            'name' => 'Lokasi Baru',
        ];

        $response = $this->patch(route('location.update'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('locations', ['id' => $location->id, 'name' => 'Lokasi Baru']);
    }
}
