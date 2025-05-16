<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\CarListing;

class BookmarkController extends Controller
{
    /**
     * Display bookmarked car listings
     */
    public function index(): View
    {
        $user = Auth::user();

        $bookmarkedCarListings = $user->userBookmarks()->latest()->paginate(12);

        return view('bookmark.index')->with('bookmarkedCarListings', $bookmarkedCarListings);
    }

    /**
     * Add - Remove bookmark
     */
    public function bookmark(CarListing $listing): RedirectResponse
    {
        $user = Auth::user();

        if ($user->userBookmarks()->where('car_listing_id', $listing->id)->exists()) {
            $user->userBookmarks()->detach($listing->id);

            return back()->with('success', 'Bookmark removed');
        } else {
            $user->userBookmarks()->attach($listing->id);

            return back()->with('success', 'Bookmark added');
        }
    }
}
