<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Costumer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'document_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vehicle()
    {
        return $this->belongsToMany(Vehicle::class)->withTimestamps();
    }
   }
