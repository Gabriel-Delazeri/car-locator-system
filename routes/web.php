<?php

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Costumer;
use App\Models\CostumerVehicle;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CostumerController;
use App\Http\Controllers\ReservesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('costumers', CostumerController::class);
Route::resource('vehicles', VehicleController::class);

Route::group([
    'prefix' => 'reserves'], function() {
        Route::get('/', [ReservesController::class, 'index']);
        Route::get('/reserve', [ReservesController::class, 'getReserveView']);
        Route::post('/', [ReservesController::class, 'reserveVehicle']);
        Route::get('/{id}/edit', [ReservesController::class, 'editReserve']);
    }
);

