<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'model',
        'car_type',
        'seats',
        'has_ac',
        'rating',
        'ratings_count',
        'price_per_day',
        'other_charges',
        'image',
        'is_available',
    ];
}
