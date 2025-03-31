<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\CarListing;

class BookmarkController extends Controller
{
    /**
     * Add - Remove bookmark.
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
