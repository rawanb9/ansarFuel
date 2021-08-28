<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carFuel extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_Id',
        'schedule_date',
        'fill_date',
        'scheduled_amount',
        'provider_Id',
        'provider',
        'user_Id',
        'status',
    ];
}
