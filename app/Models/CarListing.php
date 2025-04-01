<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarListing extends Model
{
    use HasFactory;

    protected $table = 'car_listings';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'car_maker',
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
        'zipcode',
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

    // relation to the user_bookmarks table
    public function bookmarkedCarListing(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_bookmarks')->withTimestamps();
    }
}
