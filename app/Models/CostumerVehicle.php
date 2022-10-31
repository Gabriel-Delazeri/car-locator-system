<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostumerVehicle extends Model
{
    use HasFactory;

    protected $table = 'costumer_vehicle';

    protected $fillable = [
        'vehicle_id',
        'costumer_id',
        'status',
        'start_date',
        'end_date'
    ];
}
