<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CarListing;

class CarListingImagesController extends Controller
{
    //
    public function editImages(CarListing $listing): View
    {
        return view('carListing.edit_images')->with('listing', $listing);
    }


}
