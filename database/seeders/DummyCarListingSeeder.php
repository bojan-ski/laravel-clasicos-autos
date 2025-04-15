<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CarMaker;
use App\Models\CarListing;

class DummyCarListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {      
        CarListing::factory(300)->create([
            'user_id' => function () {
                return User::where('role', 'app_user')->inRandomOrder()->first()->id;
            },
            'car_maker' => function () {
                return CarMaker::inRandomOrder()->first()->name;
            },
        ]);
    }
}
