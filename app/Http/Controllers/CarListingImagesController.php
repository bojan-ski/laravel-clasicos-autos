<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\CarListing;

class CarListingImagesController extends Controller
{
    // Display edit images page
    public function editImages(CarListing $listing): View
    {
        return view('carListing.edit_images')->with('listing', $listing);
    }

    // Set image as primary
    public function setAsPrimaryImage(Request $request, CarListing $listing): RedirectResponse
    {
        $imagePath = $request->input('image');
        $images = json_decode($listing->images) ?? [];

        // clean up image path
        if (Str::contains($imagePath, '/storage/')) {
            $imagePath = Str::replaceFirst('/storage/', '', $imagePath);
        }

        // check if image is in array/images
        $key = array_search($imagePath, $images);

        // if image is in array
        if ($key !== false) {
            // remove the image from its current position
            unset($images[$key]);

            // reset images order
            $images = array_values($images);

            // add the image to the beginning of the array
            array_unshift($images, $imagePath);

            // update listing
            $listing->images = json_encode($images);
            $listing->save();

            // redirect user
            return redirect()->route('listings.editImages', $listing)->with('success', 'Primary image changed!');
        }

        // redirect user
        return redirect()->route('listings.editImages', $listing)->with('error', 'There was an error!');
    }
}
