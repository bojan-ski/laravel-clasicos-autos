<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\CarListing;
use App\Models\CarMaker;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CarListingController extends Controller
{
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

        // Create car listing without images first
        $car = CarListing::create(array_diff_key($formData, ['images' => '']));

        // Process images if they exist
        if ($request->hasFile('images')) {
            $this->processAndSaveImages($request->file('images'), $car);
        }

        return redirect()->route('profile.index')->with('success', 'Car listing created successfully!');       
    }

    private function processAndSaveImages(array $images, CarListing $car): void
    {
        $carImagesDir = 'cars/' . $car->id;
        $imageData = [];
        
        foreach ($images as $image) {
            // Generate a safe filename
            $filename = Str::uuid() . '.' . $image->extension();
            $filePath = $carImagesDir . '/' . $filename;
    
            // Initialize the ImageManager with GD driver
            $manager = new ImageManager(new Driver());
    
            // Process the image with Intervention Image
            $img = $manager->read($image->path());
    
            // First resize large images to reasonable dimensions
            $maxDimension = 2000; // Maximum width or height
            if ($img->width() > $maxDimension || $img->height() > $maxDimension) {
                $img->resize($maxDimension, $maxDimension, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
    
            // Create the temp directory if it doesn't exist
            $tempDir = storage_path('app/temp');

            // Adaptive compression to target ~1MB
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            $tempPath = $tempDir . '/' . Str::random(40);
            $quality = 85;
            
            // Save with the initial quality
            $img->save($tempPath, quality: $quality);
    
            // More gradual quality reduction
            while (file_exists($tempPath) && filesize($tempPath) > 1000000 && $quality > 20) {
                $quality -= 5;
                $img->save($tempPath, quality: $quality);
            }
    
            // Store the processed image
            Storage::disk('public')->put($filePath, file_get_contents($tempPath));
    
            // Store image data in array
            $imageData[] = $filePath;
    
            // Clean up temp file
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
        }
        
        // Update the car listing with the JSON data
        $car->images = json_encode($imageData);
        $car->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(CarListing $listing): View
    {
        return view('carListing.show')->with('listing', $listing);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
