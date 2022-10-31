<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\Costumer;
use App\Models\CostumerVehicle;
use App\Services\ReserveVehicleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReserveVehicleServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     * @throws Exception
     */
    public function test_disponibility_succesfuly()
    {
        $vehicle = Vehicle::factory()->create();
        $reserveVehicleService = new ReserveVehicleService();
        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays(10)->format('Y-m-d');

        $period = [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $this->assertEmpty($reserveVehicleService->checkDisponibility($vehicle, $period));
    }

    /**
     * @return void
     * @throws Exception
     */
    public function test_disponibility_of_reserved_day_using_the_same_interval()
    {
        $this->expectException('Exception');

        $reserveVehicleService = new ReserveVehicleService();

        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();

        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays(10)->format('Y-m-d');

        $costumer->vehicle()->attach($vehicle->id, [
            'start_date' => $startDate,
            'end_date'   => $endDate,
        ]);

        $period = [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $reserve = $reserveVehicleService->checkDisponibility($vehicle, $period);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function test_disponibility_of_reserved_vehicle_using_an_date_in_the_period()
    {
        $this->expectException('Exception');

        $reserveVehicleService = new ReserveVehicleService();

        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();

        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addDays(10)->format('Y-m-d');

        $costumer->vehicle()->attach($vehicle->id, [
            'start_date' => $startDate,
            'end_date'   => $endDate,
        ]);

        $checkDate = Carbon::now()->addDays(4)->format('Y-m-d');

        $period = [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $reserveVehicleService->checkDisponibility($vehicle, $period);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function test_disponibility_of_reserved_vehicle_using_an_date_between_two_reserves()
    {
        $reserveVehicleService = new ReserveVehicleService();

        $vehicle = Vehicle::factory()->create();
        $costumer = Costumer::factory()->create();

        $startDatePeriod1 = Carbon::now()->format('Y-m-d');
        $endDatePeriod1 = Carbon::now()->addDays(3)->format('Y-m-d');

        $startDatePeriod2 = Carbon::now()->addDays(5)->format('Y-m-d');
        $endDatePeriod2 = Carbon::now()->addDays(8)->format('Y-m-d');

        $costumer->vehicle()->attach($vehicle->id, [
            'start_date' => $startDatePeriod1,
            'end_date'   => $endDatePeriod1,
        ]);

        $costumer->vehicle()->attach($vehicle->id, [
            'start_date' => $startDatePeriod2,
            'end_date'   => $endDatePeriod2,
        ]);

        $reserveStartDate = Carbon::now()->addDays(4)->format('Y-m-d');
        $reserveEndDate = Carbon::now()->addDays(4)->format('Y-m-d');

        $period = [
            'start_date' => $reserveStartDate,
            'end_date' => $reserveEndDate,
        ];

        $this->assertEmpty($reserveVehicleService->checkDisponibility($vehicle, $period));
    }
}
