<?php

namespace App\Services;

use DB;
use App\Models\Vehicle;
use App\Models\Costumer;
use App\Models\CostumerVehicle;

class ReserveVehicleService
{
    /**
     * @param Vehicle $vehicle
     * @param Costumer $costumer
     * @param array $period
     * @return void
     */
    public function reserveToCostumer(Vehicle $vehicle, Costumer $costumer, array $period)
    {
        $costumer->vehicle()->attach($vehicle->id, [
            'start_date' => $period['start_date'],
            'end_date'   => $period['end_date']
        ]);
    }

    /**
     * @param Vehicle $vehicle
     * @param array $period
     * @return void
     * @throws \Exception
     */
    public function checkDisponibility(Vehicle $vehicle, array $period)
    {
        $reservesInThatDay = CostumerVehicle::where('vehicle_id', $vehicle->id)
        ->where('start_date', '<=', $period['start_date'])
        ->where('end_date', '>=', $period['end_date'])
        ->count();

        if ($reservesInThatDay > 0) {
            throw new \Exception('Carro já reservado nesse dia.');
        }
    }
}
