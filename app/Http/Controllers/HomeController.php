<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use App\Models\CarMaker;
use App\Models\CarListing;

class HomeController extends Controller
{
    /**
     * Display home page
     */
    public function index(): View
    {
        // based on today's date get car make
        $dayOfMonth = Carbon::today()->format('d');
        $promoCarMaker = CarMaker::find($dayOfMonth);
        $promoListings = CarListing::where('car_maker', $promoCarMaker->name)->get();

        // get 8 latest car listings
        $lastListings = CarListing::orderBy('created_at', 'desc')->take(8)->get();

        // display/return view
        return view('home.index')
            ->with('promoCarMaker', $promoCarMaker)
            ->with('promoListings', $promoListings)
            ->with('lastListings', $lastListings);
    }
}
