<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class CarListingOwnerController extends Controller
{
    /**
     * Display selected car listing owner and all posted car listings by that owner.
     */
    public function index(): View
    {
        // get car listing owner id
        $carListingOwnerId = session()->get('car_listing_owner_id', []);

        // get car listing owner information
        $carListingOwner = User::where('id', $carListingOwnerId)->first();

        // get all car listing owner listings
        $listings = $carListingOwner->userCarListings()->latest()->paginate(12);

        // display/return view
        return view('carListingOwner.index')
            ->with('listings', $listings)
            ->with('carListingOwner', $carListingOwner);
    }
}
