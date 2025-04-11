<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\CarListing;
use App\Models\CarMaker;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CarListingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $listings = CarListing::latest()->paginate(12);

        return view('carListing.index')->with('listings', $listings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carMakers = CarMaker::all()->pluck('name', 'id')->toArray();

        return view('carListing.create')->with('carMakers', $carMakers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Run php artisan storage:link to create a symbolic link from public/storage to storage/app/public

        // validate new car listing form data
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'car_maker' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . now()->year,
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string|in:Manual,Automatic',
            'fuel_type' => 'required|string|in:Gasoline,Diesel',
            'engine_size' => 'nullable|string|max:50',
            'engine_type' => 'nullable|string|max:100',
            'engine_history' => 'required|string|in:Original Engine,Replaced Engine,Rebuilt Engine',
            'engine_condition' => 'required|string|in:Running,Needs Tuning,Not Running,Rebuilt Engine,Original Factory Engine',
            'restoration_history' => 'required|string|in:Fully Restored,Partially Restored,Barn Find,Unrestored Original',
            'original_parts_percentage' => 'nullable|numeric|min:0|max:100',
            'body_type' => 'nullable|string|in:Coupe,Sedan,Convertible,Wagon',
            'seat_material' => 'nullable|string|in:Leather,Cloth,Vinyl,Velour',
            'odometer' => 'required|string|in:Original,Rebuilt,Unknown',
            'license_plate_type' => 'nullable|string|in:Original Plate,Modern Plate,No Plate',
            'documentation_status' => 'required|string|in:Original Papers,Missing Papers,Custom Registration',
            'exterior_color' => 'nullable|string|max:50',
            'exterior_condition' => 'nullable|string|in:Showroom Condition,Good,Fair,Needs Restoration',
            'interior_color' => 'nullable|string|max:50',
            'interior_condition' => 'nullable|string|in:Showroom Condition,Good,Fair,Needs Restoration',
            'location_city' => 'required|string|max:100',
            'location_state' => 'required|string|max:100',
            'location_zipcode' => 'required|string|max:20',
            'description' => 'required|string|max:5000',
            'images' => 'required|array|min:1|max:8',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        // get user ID
        $userId = Auth::user();
        $formData['user_id'] = $userId->id;

        try {
            // begin db transaction
            DB::beginTransaction();

            // create car listing without images
            $car = CarListing::create(array_diff_key($formData, ['images' => '']));

            // process images             
            $this->processAndSaveImages($request->file('images'), $car);

            // if all is good - commit transaction
            DB::commit();

            // redirect user
            return redirect()->route('profile.index')->with('success', 'Car listing created successfully!');
        } catch (\Exception $e) {
            // rollback db transaction
            DB::rollBack();

            // redirect user
            return redirect()->route('profile.index')->with('error', 'There was an error!');
        }
    }

    private function processAndSaveImages(array $images, CarListing $car): void
    {
        try {
            // create path for images
            $carImagesDir = 'cars/' . $car->id;
            $imageData = [];

            foreach ($images as $image) {
                // generate filename
                $filename = Str::uuid() . '.' . $image->extension();
                $filePath = $carImagesDir . '/' . $filename;

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
                $imageData[] = $filePath;

                // clean up temp file
                if (file_exists($tempPath)) {
                    unlink($tempPath);
                }
            }

            // update the car listing with the JSON data - images
            $car->images = json_encode($imageData);
            $car->save();
        } catch (\Exception $e) {
            // rollback db transaction
            DB::rollBack();

            // delete the incomplete car listing
            $car->delete();

            // error msg
            throw new \Exception('Image processing failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarListing $listing): View
    {
        // get car listing owner
        $carListingOwner = $listing->user;

        // get the total number of listings of the car listing owner
        $totalNumOfCarListings = CarListing::where('user_id', $listing->user_id)->count();

        // display/return view
        return view('carListing.show')
            ->with('listing', $listing)
            ->with('carListingOwner', $carListingOwner)
            ->with('totalNumOfCarListings', $totalNumOfCarListings);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarListing $listing): View
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // get car makes list form db
        $carMakers = CarMaker::all()->pluck('name', 'id')->toArray();

        // display/return view
        return view('carListing.edit')->with('listing', $listing)->with('carMakers', $carMakers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarListing $listing)
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // validate new car listing form data
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'car_maker' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . now()->year,
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string|in:Manual,Automatic',
            'fuel_type' => 'required|string|in:Gasoline,Diesel',
            'engine_size' => 'nullable|string|max:50',
            'engine_type' => 'nullable|string|max:100',
            'engine_history' => 'required|string|in:Original Engine,Replaced Engine,Rebuilt Engine',
            'engine_condition' => 'required|string|in:Running,Needs Tuning,Not Running,Rebuilt Engine,Original Factory Engine',
            'restoration_history' => 'required|string|in:Fully Restored,Partially Restored,Barn Find,Unrestored Original',
            'original_parts_percentage' => 'nullable|numeric|min:0|max:100',
            'body_type' => 'nullable|string|in:Coupe,Sedan,Convertible,Wagon',
            'seat_material' => 'nullable|string|in:Leather,Cloth,Vinyl,Velour',
            'odometer' => 'required|string|in:Original,Rebuilt,Unknown',
            'license_plate_type' => 'nullable|string|in:Original Plate,Modern Plate,No Plate',
            'documentation_status' => 'required|string|in:Original Papers,Missing Papers,Custom Registration',
            'exterior_color' => 'nullable|string|max:50',
            'exterior_condition' => 'nullable|string|in:Showroom Condition,Good,Fair,Needs Restoration',
            'interior_color' => 'nullable|string|max:50',
            'interior_condition' => 'nullable|string|in:Showroom Condition,Good,Fair,Needs Restoration',
            'location_city' => 'required|string|max:100',
            'location_state' => 'required|string|max:100',
            'location_zipcode' => 'required|string|max:20',
            'description' => 'required|string|max:5000'
        ]);

        try {
            // update car listing without updating images
            $listing->update($formData);

            // redirect user
            return redirect()->route('profile.index')->with('success', 'Car listing updated successfully!');
        } catch (\Exception $e) {
            // redirect user
            return redirect()->route('profile.index')->with('error', 'There was an error updating car listing!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarListing $listing): RedirectResponse
    {
        // check if user is owner of the car listing
        $this->authorize('update', $listing);

        // delete images from storage
        $listingImagesDir = 'cars/' . $listing->id;

        if (isset($listingImagesDir)) Storage::disk('public')->deleteDirectory($listingImagesDir);

        // delete from database
        try {
            $listing->delete();

            // redirect user
            return redirect()->route('profile.index')->with('success', 'Car listing deleted.');
        } catch (\Exception $e) {
            // error msg
            return redirect()->route('profile.index')->with('error', 'There was an error deleting car listing!');
        }
    }
}
