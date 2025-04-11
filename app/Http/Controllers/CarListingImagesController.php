<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\CarListing;
use Illuminate\Support\Facades\Storage;

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

        // if image is not in array - redirect user with error
        return back()->with('error', 'There was an error updating the primary image!');
    }

    // Delete image
    public function destroyImage(Request $request, CarListing $listing): RedirectResponse
    {
        $imagePath = $request->input('image');
        $images = json_decode($listing->images) ?? [];

        // if there is only one image in images array
        if(count($images) <= 1) return back()->with('error', 'There needs to be at least one image!');

        // clean up image path
        if (Str::contains($imagePath, '/storage/')) {
            $imagePath = Str::replaceFirst('/storage/', '', $imagePath);
        }

        // check if image is in images array
        $key = array_search($imagePath, $images);

        // if image is in images array
        if ($key !== false) {
            // delete image from storage
            Storage::disk('public')->delete($imagePath);

            // delete image from database
            unset($images[$key]);

            $images = array_values($images);

            $listing->images = json_encode($images);
            $listing->save();

            // redirect user
            return redirect()->route('listings.editImages', $listing)->with('success', 'Image deleted.');
        }

        // if image is not in array - redirect user with error
        return back()->with('error', 'There was an error deleting the image!');
    }
}
