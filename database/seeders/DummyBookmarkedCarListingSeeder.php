<?php

namespace Database\Seeders;

use App\Models\CarListing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyBookmarkedCarListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get test user
        $user = User::where('email', 'test@test.com')->firstOrFail();

        // get car listings ids
        $carListingsIds = CarListing::pluck('id')->toArray();

        // attach dummy bookmarks to the test user 
        $randCarListingsIds = array_rand($carListingsIds, 10);

        foreach ($randCarListingsIds as $listingId) {
            $user->userBookmarks()->attach($carListingsIds[$listingId]);
        }
    }
}
