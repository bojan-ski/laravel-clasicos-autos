<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\CarListing;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
            return back()->with('success', 'Primary image changed!');
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
        if (count($images) <= 1) return back()->with('error', 'There needs to be at least one image!');

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
            return back()->with('success', 'Image deleted.');
        }

        // if image is not in array - redirect user with error
        return back()->with('error', 'There was an error deleting the image!');
    }

    // add new image/images
    public function addNewImages(Request $request, CarListing $listing): RedirectResponse
    {
        // check if images gallery is over 8 images
        $existingImages = json_decode($listing->images) ?? [];
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

        // process images        
        try {
            $this->processAndSaveImages($request->file('images'), $listing, $existingImages);

            // redirect user
            return redirect()->route('listings.editImages', $listing)->with('success', 'Images gallery updated');
        } catch (\Exception $e) {
            // redirect user with error
            return back()->with('error', 'There was an error updating the images gallery!');
        }
    }

    // process uploaded image/images and update listing/images gallery
    public function processAndSaveImages(array $formDataImages, CarListing $listing, array $existingImages = []): void
    {
        try {
            // create path for images
            $listingImagesDir = 'cars/' . $listing->id;
            $carListingImages = [];

            foreach ($formDataImages as $image) {
                // generate filename
                $filename = Str::uuid() . '.' . $image->extension();
                $filePath = $listingImagesDir . '/' . $filename;

                // initialize ImageManager with GD driver
                $manager = new ImageManager(new Driver());

                // process the image with Intervention Image
                $img = $manager->read($image->path());

                // resize large images to reasonable dimensions
                $maxDimension = 2000; // set width/height - it will be 1024x1024
                if ($img->width() > $maxDimension || $img->height() > $maxDimension) {
                    $img->resize($maxDimension, $maxDimension, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // create the 'temp' directory if it doesn't exist
                $tempDir = storage_path('app/temp');

                if (!file_exists($tempDir)) {
                    mkdir($tempDir, 0777, true);
                }

                // adaptive compression to target ~1MB
                $tempPath = $tempDir . '/' . Str::random(40);
                $quality = 85;

                // save with the initial quality
                $img->save($tempPath, quality: $quality);

                // More gradual quality reduction
                while (file_exists($tempPath) && filesize($tempPath) > 1000000 && $quality > 20) {
                    $quality -= 5;
                    $img->save($tempPath, quality: $quality);
                }

                // store the processed image into the storage/app/public folder
                Storage::disk('public')->put($filePath, file_get_contents($tempPath));

                // store image data in array - images
                $carListingImages[] = $filePath;

                // clean up temp file
                if (file_exists($tempPath)) {
                    unlink($tempPath);
                }
            }

            if (count($existingImages) > 0) {
                // merge existing images with new images
                $updatedCarListingImages = array_merge($existingImages, $carListingImages);

                // update the car listing with the combined image data
                $listing->images = json_encode($updatedCarListingImages);
            } else {
                // update the car listing with the JSON data - images
                $listing->images = json_encode($carListingImages);
            }

            // save images in database
            $listing->save();
        } catch (\Exception $e) {
            if (count($existingImages) == 0){
                // rollback db transaction
                DB::rollBack();
    
                // delete the incomplete car listing
                $listing->delete();
            }

            // error msg
            throw new \Exception('Image processing failed');
        }
    }
}
