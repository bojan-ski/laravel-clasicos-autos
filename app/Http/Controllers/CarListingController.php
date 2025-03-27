<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CarListing;

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
                    ->orWhereRaw('LOWER(make) like ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(model) like ?', ['%' . $searchTerm . '%']);
            });
        }

        $listings = $query->paginate(12);

        return view('carListing.index')->with('listings', $listings);
    }

    /**
     * Search the specified resource - filter option
     */
    public function filter(Request $request) {}
}
