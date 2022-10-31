<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Costumer;
use App\Models\CostumerVehicle;
use App\Services\ReserveVehicleService;
use App\Http\Requests\Reserves\ReserveVehicleRequest;
use App\Http\Requests\Reserves\UpdateReserveRequest;

class ReservesController extends Controller
{
    private $reserveVehicleService;

    /**
     * @param ReserveVehicleService $reserveVehicleService
     */
    public function __construct(ReserveVehicleService $reserveVehicleService)
    {
        $this->reserveVehicleService = $reserveVehicleService;
    }

    /**
     * return view
     */
    public function index()
    {
        return view('reserves.index')->with('reserves', CostumerVehicle::all()->toArray());
    }

    /**
     * return view
     */
    public function getReserveView()
    {
        $vehicles = Vehicle::all()->toArray();
        $costumers = Costumer::all()->toArray();

        return view('reserves.reserve', compact('vehicles', 'costumers'));
    }

    /**
     * @param ReserveVehicleRequest $request
     * return redirect
     */
    public function reserveVehicle(ReserveVehicleRequest $request)
    {
        try {
            $costumer = Costumer::find($request->input('costumer'));
            $vehicle = Vehicle::find($request->input('vehicle'));

            $this->reserveVehicleService->checkDisponibility($vehicle, $request->validated());
            $this->reserveVehicleService->reserveToCostumer($vehicle, $costumer, $request->validated());

            return self::index();
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return redirect('/reserves/reserve')->with('error','Veiculo já está reservado nessa data!');
        }
    }

    /**
     * @param CostumerVehicle $reserve
     * @return void
     */
    public function edit(CostumerVehicle $reserve)
    {
        $vehicles = Vehicle::all()->toArray();
        $costumers = Costumer::all()->toArray();

        return view('reserves.edit' , compact('reserve', 'vehicles', 'costumers'));
    }

    public function update(UpdateReserveRequest $request, CostumerVehicle $reserve)
    {
        try {
            $vehicle = Vehicle::find($request->validated('vehicle'));
            $this->reserveVehicleService->checkDisponibilityUpdateReserve($reserve, $vehicle, $request->validated());
            $this->reserveVehicleService->updateReserve($reserve, $request->validated());

            return self::index();
        } catch(\Exception $e) {
            return redirect("/reserves/{$reserve->id}/edit")->with('error','Veiculo já está reservado nessa data!');
        }
    }

    /**
     * @param CostumerVehicle $reserve
     * @return void
     */
    public function showReserve(CostumerVehicle $reserve)
    {
        return view('reserves.show')->with('reserve', $reserve);
    }

    /**
     * @param CostumerVehicle $reserve
     * @return void
     */
    public function deleteReserve(CostumerVehicle $reserve)
    {
        $reserve->delete();

        return redirect('/reserves')->with('success','Reserva deletada com sucesso!');
    }
}
