<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial',
        'timestamp',
        'name',
        'phone',
        'fuel_type',
        'car_type',
        'car_color',
        'car_plate',
        'preferred_provider_id',
    ];
}
