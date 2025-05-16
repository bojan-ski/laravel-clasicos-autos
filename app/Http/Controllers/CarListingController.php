<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\CarListingRequest;
use App\Models\CarListing;
use App\Models\CarMaker;
use App\Traits\ProcessImagesTrait;

class CarListingController extends Controller
{
    use AuthorizesRequests;
    use ProcessImagesTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // get all car listings
        $listings = CarListing::latest()->paginate(12);

        // display/return view
        return view('carListing.index')->with('listings', $listings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // check if user is not admin user
        $this->authorize('create', CarListing::class);

        // get car makes list from db
        $carMakers = CarMaker::all()->pluck('name', 'id')->toArray();

        // display/return view
        return view('carListing.create')->with('carMakers', $carMakers);
    }

    /**
     * Store a newly created resource in storage.
     */
    // Run php artisan storage:link to create a symbolic link from public/storage to storage/app/public
    public function store(CarListingRequest $request): RedirectResponse
    {
        // check if user is not admin user
        $this->authorize('create', CarListing::class);

        // validate new car listing form data
        $formData = $request->validated();

        // get/set user ID
        $userId = Auth::user();
        $formData['user_id'] = $userId->id;

        // create new car listing
        try {
            // begin db transaction
            DB::beginTransaction();

            // create car listing without images
            $newListing = CarListing::create(array_diff_key($formData, ['images' => '']));

            // process images - run processAndSaveImages method from ProcessImagesTrait
            $this->processAndSaveImages($request->file('images'), $newListing);

            // if all is good - commit transaction
            DB::commit();

            // redirect user - with success msg
            return redirect()->route('profile.index')->with('success', 'Car listing created successfully!');
        } catch (\Exception $e) {
            // rollback db transaction
            DB::rollBack();

            // redirect user - with error msg
            return redirect()->route('profile.index')->with('error', 'There was an error!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarListing $listing): View
    {
        // get car listing owner profile data
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
        // check if user is owner of the car listing or is admin user
        $this->authorize('update', $listing);

        // get car makes list from db
        $carMakers = CarMaker::all()->pluck('name', 'id')->toArray();

        // display/return view
        return view('carListing.edit')
            ->with('listing', $listing)
            ->with('carMakers', $carMakers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarListingRequest $request, CarListing $listing)
    {
        // check if user is owner of the car listing or is admin user
        $this->authorize('update', $listing);

        // validate new car listing form data
        $formData = $request->validated();

        try {
            // update car listing without updating images
            $listing->update($formData);

            // redirect user - with success msg
            $segments = request()->segments();

            return redirect($segments[0] . '/' . $segments[1])->with('success', 'Car listing updated successfully.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error updating car listing!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarListing $listing): RedirectResponse
    {
        // check if user is owner of the car listing or is admin user
        $this->authorize('update', $listing);

        // set route
        $route = Auth::user()->role == 'admin_user' ? 'listings' : 'profile.index';

        try {
            // delete images from storage
            $listingImagesDir = 'cars/' . $listing->id;
            Storage::disk('public')->deleteDirectory($listingImagesDir);

            // delete from database
            $listing->delete();

            // redirect user - with success msg           
            return redirect()->route($route)->with('success', 'Car listing deleted.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return redirect()->route($route)->with('error', 'There was an error deleting car listing!');
        }
    }
}
