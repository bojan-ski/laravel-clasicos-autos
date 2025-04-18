<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CarListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'model' => $this->faker->randomElement(['Bel Air', 'Mustang', 'Corvette', 'Beetle', 'Camaro', 'Thunderbird']),
            'year' => $this->faker->numberBetween(1920, 1985),
            'mileage' => $this->faker->numberBetween(1000, 200000),
            'exterior_color' => $this->faker->safeColorName(),
            'interior_color' => $this->faker->safeColorName(),
            'transmission' => $this->faker->randomElement(['Manual', 'Automatic']),
            'fuel_type' => $this->faker->randomElement(['Gasoline', 'Diesel']),
            'engine_size' => $this->faker->randomFloat(1, 1.5, 7.0) . 'L',
            'engine_type' => $this->faker->randomElement(['V8', 'Inline-6', 'Flat-4', 'Straight-8', 'Rotary', 'Boxer']),
            'odometer' => $this->faker->randomElement(['Original', 'Rebuilt', 'Unknown']),
            'exterior_condition' => $this->faker->randomElement(['Showroom Condition', 'Good', 'Fair', 'Needs Restoration']),
            'interior_condition' => $this->faker->randomElement(['Showroom Condition', 'Good', 'Fair', 'Needs Restoration']),
            'seat_material' => $this->faker->randomElement(['Leather', 'Cloth', 'Vinyl', 'Velour']),
            'engine_history' => $this->faker->randomElement(['Original Engine', 'Replaced Engine', 'Rebuilt Engine']),
            'engine_condition' => $this->faker->randomElement(['Running', 'Needs Tuning', 'Not Running', 'Rebuilt Engine', 'Original Factory Engine']),
            'price' => $this->faker->numberBetween(10000, 100000),
            'location_city' => $this->faker->city(),
            'location_state' => $this->faker->state(),
            'location_zipcode' => substr($this->faker->postcode(), 0, 5),
            'images' => json_encode([
                'https://placehold.co/640x480.png?text=Car+1',
                'https://placehold.co/640x480.png?text=Car+2',
                'https://placehold.co/640x480.png?text=Car+3',
                'https://placehold.co/640x480.png?text=Car+4',
                'https://placehold.co/640x480.png?text=Car+5',
                'https://placehold.co/640x480.png?text=Car+6',
                'https://placehold.co/640x480.png?text=Car+7',
                'https://placehold.co/640x480.png?text=Car+8',
            ]),
            'body_type' => $this->faker->randomElement(['Coupe', 'Sedan', 'Convertible', 'Wagon']),
            'restoration_history' => $this->faker->randomElement(['Fully Restored', 'Partially Restored', 'Barn Find', 'Unrestored Original']),
            'original_parts_percentage' => $this->faker->numberBetween(10, 100),
            'license_plate_type' => $this->faker->randomElement(['Original Plate', 'Modern Plate', 'No Plate']),
            'documentation_status' => $this->faker->randomElement(['Original Papers', 'Missing Papers', 'Custom Registration']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
