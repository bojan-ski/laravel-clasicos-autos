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
        'model',
        'car_maker',
        'year',
        'mileage',
        'transmission',
        'fuel_type',
        'engine_size',
        'engine_type',
        'engine_history',
        'engine_condition',
        'restoration_history',
        'body_type',
        'seat_material',
        'odometer',
        'license_plate_type',
        'documentation_status',
        'exterior_color',
        'exterior_condition',
        'interior_color',
        'interior_condition',
        'original_parts_percentage',
        'location_city',
        'location_state',
        'location_zipcode',
        'price',
        'images',
    ];

    // relation to the users table
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
