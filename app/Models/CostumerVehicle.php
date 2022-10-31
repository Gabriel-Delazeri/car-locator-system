<?php

namespace App\Models;

use App\Models\Costumer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostumerVehicle extends Model
{
    use HasFactory;

    protected $table = 'costumer_vehicle';

    protected $fillable = [
        'vehicle_id',
        'costumer_id',
        'start_date',
        'end_date'
    ];

    public function costumer()
    {
        return $this->hasOne(Costumer::class, 'id', 'costumer_id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
}
