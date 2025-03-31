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
    public function addToCompare(Request $request, $listingId): RedirectResponse
    {
        $compareListings = $request->session()->get('compare_listings', []);

        if (!in_array($listingId, $compareListings) && count($compareListings) < 2) {
            $compareListings[] = $listingId;

            $request->session()->put('compare_listings', $compareListings);

            return back()->with('success', 'Car listings added for compare');
        }

        return back()->with('error', 'Only two listings can be compared!');
    }

    /**
     * Remove car listing to the compare_listings - session
     */
    public function removeFromCompare(Request $request, $listingId): RedirectResponse
    {
        $compareListings = $request->session()->get('compare_listings', []);
        $index = array_search($listingId, $compareListings);

        if ($index !== false) {
            unset($compareListings[$index]);

            $request->session()->put('compare_listings', array_values($compareListings));

            return back()->with('success', 'Car listings removed from compare');
        }

        return back()->with('error', 'There was an error!');
    }

    /**
     * Display selected car listings for compare 
     */
    public function showCompare(Request $request): View
    {
        $selectedCarListingsIds = $request->session()->get('compare_listings', []);
        $selectedCarListings = CarListing::whereIn('id', $selectedCarListingsIds)->get();

        return view('carListing.compare')->with('selectedCarListings', $selectedCarListings);
    }

    /**
     * Clear compare page
     */
    public function clearCompare(Request $request): RedirectResponse
    {
        $request->session()->forget('compare_listings');

        return back()->with('success', 'Selected listings removed');
    }
}
