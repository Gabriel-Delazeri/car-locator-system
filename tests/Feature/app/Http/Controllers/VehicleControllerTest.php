<?php

namespace Tests\Feature\app\Http\Controllers;

use Tests\TestCase;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VehicleControllerTest extends TestCase
{
    use DatabaseMigrations;

    public const BASE_URL = '/vehicles';

    /**
     * @return void
     */
    public function test_index_method_is_returning_vehicles_list_and_view_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = Vehicle::factory()->count(10)->create();

        $response = $this->get(Self::BASE_URL);

        $compactVehicle = $response->viewData('vehicles');

        $response->assertStatus(200);
        $response->assertViewIs('vehicles.index');
        $this->assertSame($vehicle->count(), sizeof($compactVehicle));
    }

    /**
     * @return void
     */
    public function test_create_method_is_returning_create_view_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $response = $this->get(Self::BASE_URL . '/create');
        $response->assertStatus(200);
        $response->assertViewIs('vehicles.create');
    }

    /**
     * @return void
     */
    public function test_store_vehicle_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = Vehicle::factory()->raw();

        $response = $this->post(Self::BASE_URL, $vehicle);

        $response->assertStatus(302);
        $this->assertDatabaseHas('vehicles', [
            'plate' => $vehicle['plate']
        ]);
    }

    /**
     * @return void
     */
    public function test_store_validations_waiting_error()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = [];

        $response = $this->post(Self::BASE_URL, $vehicle);

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_show_method_is_returning_vehicle_and_view_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = Vehicle::factory()->create();

        $response = $this->get(Self::BASE_URL . "/{$vehicle->id}");

        $compactVehicle = $response->viewData('vehicle');

        $response->assertViewIs('vehicles.show');
        $this->assertEquals($compactVehicle->toArray(), $vehicle->toArray());
    }

    /**
     * @return void
     */
    public function test_edit_is_returning_vehicle_and_view_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = Vehicle::factory()->create();

        $response = $this->get(Self::BASE_URL . "/{$vehicle->id}/edit");

        $compactVehicle = $response->viewData('vehicle');

        $response->assertViewIs('vehicles.edit');
        $this->assertEquals($compactVehicle->toArray(), $vehicle->toArray());
    }

    /**
     * @return void
     */
    public function test_updating_vehicle_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = Vehicle::factory()->create();

        $update = [
            "model"  => "PHPUNIT",
            "brand"   => $vehicle->brand,
            "year" => $vehicle->year,
            "plate" => $vehicle->plate,
        ];

        $this->put(Self::BASE_URL . "/{$vehicle->id}", $update);

        $updatedVehicle = Vehicle::find($vehicle->id)->toArray();
        $this->assertEquals('PHPUNIT', $updatedVehicle['model']);
    }

    /**
     * @return void
     */
    public function test_delete_vehicle_succesfuly()
    {
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);

        $vehicle = Vehicle::factory()->create();

        $this->delete(Self::BASE_URL . "/{$vehicle->id}");
        $this->assertEmpty(Vehicle::find($vehicle->id));
    }
}
