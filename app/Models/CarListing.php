<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarListing extends Model
{
    use HasFactory;

    protected $table = 'car_listings';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'make',
        'model',
        'year',
        'mileage',
        'exterior_color',
        'interior_color',
        'transmission',
        'fuel_type',
        'engine_size',
        'engine_type',
        'odometer',
        'exterior_condition',
        'interior_condition',
        'seat_material',
        'engine_history',
        'engine_condition',
        'price',
        'location_city',
        'location_state',
        'images',
        'body_type',
        'restoration_history',
        'original_parts_percentage',
        'license_plate_type',
        'documentation_status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
