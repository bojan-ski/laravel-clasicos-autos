<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'make' => $this->faker->randomElement(['Ford', 'Chevrolet', 'Buick', 'Cadillac', 'Mercedes-Benz', 'Volkswagen']),
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
            'price' => $this->faker->randomFloat(2, 5000, 100000),
            'location_city' => $this->faker->city(),
            'location_state' => $this->faker->state(),
            'images' => json_encode([$this->faker->imageUrl(640, 480, 'cars', true)]),
            'body_type' => $this->faker->randomElement(['Coupe', 'Sedan', 'Convertible', 'Wagon']),
            'restoration_history' => $this->faker->randomElement(['Fully Restored', 'Partially Restored', 'Barn Find', 'Unrestored Original']),
            'original_parts_percentage' => $this->faker->numberBetween(50, 100),
            'license_plate_type' => $this->faker->randomElement(['Original Plate', 'Modern Plate', 'No Plate']),
            'documentation_status' => $this->faker->randomElement(['Original Papers', 'Missing Papers', 'Custom Registration']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
