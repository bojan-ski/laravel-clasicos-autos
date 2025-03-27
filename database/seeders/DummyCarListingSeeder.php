<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarListing;
use App\Models\User;

class DummyCarListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {      
        CarListing::factory(50)->create([
            'user_id' => function () {
                return User::where('role', 'app_user')->inRandomOrder()->first()->id;
            }
        ]);
    }
}
