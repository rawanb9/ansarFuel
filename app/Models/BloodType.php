<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BloodType
 * @package App\Models
 * @property string name
 */
class BloodType extends Model
{
    use HasFactory;
    protected $fillable=['name'];
}
