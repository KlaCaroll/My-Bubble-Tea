<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'drinker_name', 
        'teas_id',
        'poppings_id',
        'sugar',
        'price',
        'id',
        'status',
    ];

}
