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

    CONST BASE_URL = '/reserves';

    /**
     * @return void
     */
    public function test_reserve_a_vehicle_to_costumer()
    {
        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();

        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays()->format('Y-m-d');

        $response = $this->post(Self::BASE_URL, [
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

        $response = $this->get(Self::BASE_URL . '/reserve');

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

        $response = $this->post(Self::BASE_URL, [
            'vehicle'  => $vehicle->id,
            'costumer' => $costumer->id,
            'start_date' => $date,
            'end_date' => $date,
        ]);

        $this->assertDatabaseCount('costumer_vehicle', 1);
    }

    /**
     * @return void
     */
    public function test_reserve_edit_is_returning_a_view_succesfuly()
    {
        $vehicles = Vehicle::factory()->count(10)->create();
        $costumers = Costumer::factory()->count(10)->create();

        $reserve = CostumerVehicle::create([
            "vehicle_id"  => $vehicles->first()->id,
            "costumer_id" => $costumers->first()->id,
            "start_date"  => Carbon::now()->addDays()->format('Y-m-d'),
            "end_date"    => Carbon::now()->addDays()->format('Y-m-d')
        ]);

        $response = $this->get(Self::BASE_URL . "/{$reserve->id}/edit");

        $compactVehicles = $response->viewData('vehicles');
        $compactCostumers = $response->viewData('costumers');
        $compactReserve = $response->viewData('reserve');

        $response->assertViewIs('reserves.edit');
        $this->assertEquals(sizeof($compactVehicles), $vehicles->count());
        $this->assertEquals(sizeof($compactCostumers), $costumers->count());
        $this->assertEquals($compactReserve->toArray(), $reserve->toArray());
    }

    /**
     * @return void
     */
    public function test_show_reserve_returning_reserve_and_view_succesfuly()
    {
        $reserve = self::generateVehicleCostumerAndReturnReserve();

        $response = $this->get(Self::BASE_URL . "/{$reserve->id}");

        $compactReserve = $response->viewData('reserve');
        $this->assertEquals($compactReserve->toArray(), $reserve->toArray());
    }

    /**
     * @return void
     */
    public function test_update_reserve_succesfuly()
    {
        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays()->format('Y-m-d');

        $reserve = Self::generateVehicleCostumerAndReturnReserve($startDate, $endDate);

        $newVehicle = Vehicle::factory()->create();

        $response = $this->post(Self::BASE_URL . '/{$reserve->id}/update', [
            'vehicle'   => $newVehicle->id,
            'costumer'  => Costumer::first()->id,
            'start_date'=> $startDate,
            'end_date'  => $endDate,
        ]);

        $this->assertDatabaseHas('costumer_vehicle',[
            'id' => $reserve->id,
            'vehicle_id' => Vehicle::first()->id,
        ]);
    }

    /**
     * @return void
     */
    public function test_update_a_reserve_passing_vehicle_already_reserved()
    {
        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays()->format('Y-m-d');

        $reserve = Self::generateVehicleCostumerAndReturnReserve($startDate, $endDate);
        $reserveTwo = Self::generateVehicleCostumerAndReturnReserve($startDate, $endDate);

        $response = $this->post("/reserves/{$reserve->id}/update", [
            'vehicle'   => $reserveTwo->vehicle->id,
            'costumer'  => Costumer::first()->id,
            'start_date'=> $startDate,
            'end_date'  => $endDate,
        ]);

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_delete_reserve_succesfuly()
    {
        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays()->format('Y-m-d');

        $reserve = self::generateVehicleCostumerAndReturnReserve($startDate, $endDate);

        $response = $this->delete("/reserves/{$reserve->id}");

        $this->assertEquals(0, CostumerVehicle::count());

        $response->assertStatus(302);
    }

    /**
     * @return CostumerVehicle
     */
    private function generateVehicleCostumerAndReturnReserve($startDate = null, $endDate = null)
    {
        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();

        $reserve = CostumerVehicle::create([
            "vehicle_id"  => $vehicle->id,
            "costumer_id" => $costumer->id,
            "start_date"  => is_null($startDate) ? Carbon::now()->format('Y-m-d') : $startDate,
            "end_date"    => is_null($endDate) ? Carbon::now()->format('Y-m-d') : $endDate
        ]);

        return $reserve;
    }
}
