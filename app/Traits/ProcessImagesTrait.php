<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\CarListing;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ProcessImagesTrait
{
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
            if (count($existingImages) == 0) {
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
