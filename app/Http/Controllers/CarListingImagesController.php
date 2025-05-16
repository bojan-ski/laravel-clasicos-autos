<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\CarListing;
use App\Traits\ProcessImagesTrait;

class CarListingImagesController extends Controller
{
    use AuthorizesRequests;
    use ProcessImagesTrait;

    // Display edit images page
    public function editImages(CarListing $listing): View
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // display/return view
        return view('carListing.edit_images')->with('listing', $listing);
    }

    // Set image as primary
    public function setAsPrimaryImage(Request $request, CarListing $listing): RedirectResponse
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // get image path & existing images
        $imagePath = $request->input('image');
        $existingImages = json_decode($listing->images);

        // clean up image path
        if (Str::contains($imagePath, '/storage/')) {
            $imagePath = Str::replaceFirst('/storage/', '', $imagePath);
        }

        // check if image is in array/images
        $key = array_search($imagePath, $existingImages);

        // if image is in array
        if ($key !== false) {
            // remove the image from its current position
            unset($existingImages[$key]);

            // reset images order
            $existingImages = array_values($existingImages);

            // add the image to the beginning of the array
            array_unshift($existingImages, $imagePath);

            // update listing
            $listing->images = json_encode($existingImages);
            $listing->save();

            // redirect user - with success msg
            return back()->with('success', 'Primary image changed!');
        }

        // if image is not in array - redirect user with error
        return back()->with('error', 'There was an error changing the primary image!');
    }

    // Delete image
    public function destroyImage(Request $request, CarListing $listing): RedirectResponse
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // get image path & existing images
        $imagePath = $request->input('image');
        $existingImages = json_decode($listing->images);

        // if there is only one image in images array
        if (count($existingImages) <= 1) return back()->with('error', 'There needs to be at least one image!');

        // clean up image path
        if (Str::contains($imagePath, '/storage/')) {
            $imagePath = Str::replaceFirst('/storage/', '', $imagePath);
        }

        // check if image is in images array
        $key = array_search($imagePath, $existingImages);

        // if image is in images array
        if ($key !== false) {
            // delete image from storage
            Storage::disk('public')->delete($imagePath);

            // delete image from database
            unset($existingImages[$key]);

            $existingImages = array_values($existingImages);

            $listing->images = json_encode($existingImages);
            $listing->save();

            // redirect user - with success msg
            return back()->with('success', 'Image deleted.');
        }

        // if image is not in array - redirect user with error
        return back()->with('error', 'There was an error deleting the image!');
    }

    // add new image/images
    public function addNewImages(Request $request, CarListing $listing): RedirectResponse
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // check if images gallery is over 8 images
        $existingImages = json_decode($listing->images);
        if (count($existingImages) === 8) return back()->with('error', 'The limit is 8 images!');

        // validate form data
        $request->validate([
            'images' => 'required|array|min:1|max:7',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        // check if adding new images will exceed the limit of 8 images
        $newImagesCount = count($request->file('images'));
        $totalImagesAfterAddition = count($existingImages) + $newImagesCount;

        if ($totalImagesAfterAddition > 8) {
            return back()->with('error', 'Adding new images will exceed the limit of 8 images!');
        }

        // process images - run processAndSaveImages method from ProcessImagesTrait      
        try {
            $this->processAndSaveImages($request->file('images'), $listing, $existingImages);

            // redirect user - with success msg
            return back()->with('success', 'Images gallery updated');
        } catch (\Exception $e) {
            // redirect user with error
            return back()->with('error', 'There was an error updating the images gallery!');
        }
    }
}
