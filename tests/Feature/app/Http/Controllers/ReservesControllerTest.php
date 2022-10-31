<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\CostumerVehicle;
use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\Costumer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;

class ReservesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function test_reserve_a_vehicle_to_costumer()
    {
        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();

        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays()->format('Y-m-d');

        $response = $this->post('reserves', [
            'vehicle'   => $vehicle->id,
            'costumer'  => $costumer->id,
            'start_date'=> $startDate,
            'end_date'  => $endDate,
        ]);

        $this->assertDatabaseHas('costumer_vehicle',[
            'vehicle_id' => $vehicle->id,
            'costumer_id' => $costumer->id,
        ]);
    }

    /**
     * @return void
     */
    public function test_get_reserve_view_working_succesfuly()
    {
        $vehicles = Vehicle::factory()->count(10)->create();
        $costumers = Costumer::factory()->count(10)->create();

        $response = $this->get('/reserves/reserve');

        $compactVehicles = $response->viewData('vehicles');
        $compactCostumers = $response->viewData('costumers');

        $response->assertStatus(200);
        $response->assertViewIs('reserves.reserve');

        $this->assertSame($vehicles->count(), sizeof($compactVehicles));
        $this->assertSame($costumers->count(), sizeof($compactCostumers));
    }

    /**
     * @return void
     */
    public function test_reserve_a_vehicle_already_reserved()
    {
        $date = Carbon::now()->format('Y-m-d');

        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();
        $costumer->vehicle()->attach($vehicle->id, [
            'start_date' => $date,
            'end_date' => $date,
        ]);

        $response = $this->post('reserves', [
            'vehicle'  => $vehicle->id,
            'costumer' => $costumer->id,
            'start_date' => $date,
            'end_date' => $date,
        ]);

        $this->assertDatabaseCount('costumer_vehicle', 1);
    }
}
