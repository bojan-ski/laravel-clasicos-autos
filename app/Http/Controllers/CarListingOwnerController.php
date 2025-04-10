<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CarListing;
use App\Models\User;

class CarListingOwnerController extends Controller
{
    public function index(): View
    {
        // get car listing owner id from session
        $carListingOwnerId = session()->get('car_listing_owner', []);

        // get car listing owner information
        $carListingOwner = User::where('id', $carListingOwnerId)->first();

        // get all car listing owner listings
        $listings = CarListing::where('user_id', $carListingOwnerId)->latest()->paginate(12);

        // display/return view
        return view('carListingOwner.index')
            ->with('listings', $listings)
            ->with('carListingOwner', $carListingOwner);
    }
}
