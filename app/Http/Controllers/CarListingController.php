<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CarListing;
use App\Models\CarMaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
     * Search the specified resource - search option
     */
    public function search(Request $request): View
    {
        $searchTerm = strtolower($request->get('search_term'));

        $query = CarListing::query();

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw("LOWER(name) like ?", ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(car_maker) like ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(model) like ?', ['%' . $searchTerm . '%']);
            });
        }

        // sorting
        $query->orderBy('created_at', 'desc');

        // results
        $listings = $query->paginate(12)->appends(['search_term' => $searchTerm]);

        // display view
        return view('carListing.index')->with('listings', $listings);
    }

    /**
     * Display advance search/filter page.
     */
    public function showAdvanceSearch(): View
    {
        $carMakers = CarMaker::all()->pluck('name', 'id')->toArray();

        return view('carListing.advance_search')->with('carMakers', $carMakers);
    }

    /**
     * Search the specified resource - filter option
     */
    public function filter(Request $request)
    {
        $carMakers = CarMaker::all()->pluck('name', 'id')->toArray();

        // RUN QUERY
        $query = CarListing::query();

        // collect all filter parameters
        $filterParams = $request->except(['page']);

        // model
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }


        // mileage
        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }

        // price
        if ($request->filled('price_from') && $request->filled('price_to')) {
            $query->whereBetween('price', [
                $request->price_from,
                $request->price_to
            ]);
        } elseif ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        } elseif ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // date 
        if ($request->filled('year_from') && $request->filled('year_to')) {
            $query->whereBetween('year', [
                $request->year_from,
                $request->year_to
            ]);
        } elseif ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        } elseif ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        // color
        if ($request->filled('exterior_color')) {
            $query->where('exterior_color', 'like', '%' . $request->exterior_color . '%');
        }

        if ($request->filled('interior_color')) {
            $query->where('interior_color', 'like', '%' . $request->interior_color . '%');
        }

        // location filters
        if ($request->filled('city')) {
            $query->where('location_city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('state')) {
            $query->where('location_state', 'like', '%' . $request->state . '%');
        }

        if ($request->filled('zipcode')) {
            $query->where('location_zipcode', 'like', '%' . $request->zipcode . '%');
        }

        // selected options
        $selectedOptions = [
            'car_maker',
            'transmission',
            'fuel_type',
            'engine_size',
            'engine_type',
            'odometer',
            'exterior_condition',
            'interior_condition',
            'seat_material',
            'engine_history',
            'engine_condition',
            'body_type',
            'restoration_history',
            'license_plate_type',
            'documentation_status'
        ];

        foreach ($selectedOptions as $option) {
            if ($request->filled($option)) {
                $query->where($option, $request->input($option));
            }
        }

        // sorting
        $query->orderBy('created_at', 'desc');

        // results
        $advanceSearchResult = $query->paginate(12)->appends($filterParams);

        // display view
        return view('carListing.advance_search')->with([
            'carMakers' => $carMakers,
            'advanceSearchResult' => $advanceSearchResult
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
