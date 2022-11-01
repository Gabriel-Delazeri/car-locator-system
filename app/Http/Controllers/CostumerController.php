<?php

namespace App\Http\Controllers;

use App\Models\Costumer;
use App\Services\ReserveVehicleService;
use App\Http\Requests\Costumer\StoreCostumerRequest;
use App\Http\Requests\Costumer\UpdateCostumerRequest;

class CostumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('costumers.index')->with('costumers', Costumer::all()->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('costumers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostumerRequest $request)
    {
        Costumer::create($request->validated());

        return redirect('/costumers')->with('success','Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Costumer $costumer)
    {
        return view('costumers.show')->with('costumer', $costumer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Costumer $costumer)
    {
        return view('costumers.edit')->with('costumer', $costumer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCostumerRequest $request, Costumer $costumer)
    {
        $costumer->update($request->validated());

        return redirect('/costumers')->with('success','Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Costumer $costumer)
    {
        try {
            ReserveVehicleService::checkCostumerIsDeletable($costumer);
            $costumer->delete();
        } catch (\Exception $e) {
            return redirect('/costumers')->with('error',$e->getMessage());
        }

        return redirect('/costumers')->with('success','Cliente deletado com sucesso!');
    }
}
