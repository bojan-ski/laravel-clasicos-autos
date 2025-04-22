<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\CarListing;

class CompareController extends Controller
{
    /**
     * Add car listing to the compare_listings - session
     */
    public function addToCompare(Request $request, CarListing $listing): RedirectResponse
    {
        // get listings from session
        $compareListings = $request->session()->get('compare_listings', []);

        // check if listings in session is less than 2 & add to session
        if (!in_array($listing->id, $compareListings) && count($compareListings) < 2) {
            $compareListings[] = $listing->id;

            $request->session()->put('compare_listings', $compareListings);

            // redirect user - with success msg
            return back()->with('success', 'Car listings added for compare');
        }

        // redirect user - with error msg
        return back()->with('error', 'Only two listings can be compared!');
    }

    /**
     * Remove car listing to the compare_listings - session
     */
    public function removeFromCompare(Request $request, CarListing $listing): RedirectResponse
    {
        // get listings from session
        $compareListings = $request->session()->get('compare_listings', []);
        $index = array_search($listing->id, $compareListings);

        // remove listing from session
        if ($index !== false) {
            unset($compareListings[$index]);

            $request->session()->put('compare_listings', array_values($compareListings));

            // redirect user - with success msg
            return back()->with('success', 'Car listings removed from compare');
        }

        // redirect user - with error msg
        return back()->with('error', 'There was an error!');
    }

    /**
     * Display selected car listings for compare - compare page 
     */
    public function showCompare(Request $request): View
    {
        // get listings from session & database
        $selectedCarListingsIds = $request->session()->get('compare_listings', []);
        $selectedCarListings = CarListing::whereIn('id', $selectedCarListingsIds)->get();

        // display/return view
        return view('carListing.compare')->with('selectedCarListings', $selectedCarListings);
    }

    /**
     * Clear compare page
     */
    public function clearCompare(Request $request): RedirectResponse
    {
        // clear listings from session
        $request->session()->forget('compare_listings');

        // redirect user - with success msg
        return back()->with('success', 'Selected listings removed.');
    }
}
