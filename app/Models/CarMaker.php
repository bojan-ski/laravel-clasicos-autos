<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarMaker extends Model
{
    use HasFactory;

    protected $table = 'car_makers';
    protected $fillable = [
        'name'
    ];
}
