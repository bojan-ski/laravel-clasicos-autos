<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CarListing;

class AdminUserController extends Controller
{
    /**
     * Display all app users
     */
    public function index()
    {
        // get all app users
        $appUsers = User::where('role', 'app_user')->latest()->paginate(12);

        // get the number of car listings for each app user
        $userListingCounts = CarListing::query()
            ->select('user_id', DB::raw('COUNT(*) as listing_count'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        // display/return view
        return view('admin.index')
            ->with('appUsers', $appUsers)
            ->with('userListingCounts', $userListingCounts);
    }

    /**
     * Search for a specific user/users - search option
     */
    public function searchUser(Request $request): View
    {
        // get search term
        $searchTerm = strtolower($request->get('search_term'));

        // start query search
        $query = User::query();

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw("LOWER(username) like ?", ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(email) like ?', ['%' . $searchTerm . '%']);
            });
        }

        // results
        $appUsers = $query->latest()->paginate(12)->appends(['search_term' => $searchTerm]);

        // get the number of car listings for each app user
        $userListingCounts = CarListing::query()
            ->select('user_id', DB::raw('COUNT(*) as listing_count'))
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        // display/return view
        return view('admin.index')
            ->with('appUsers', $appUsers)
            ->with('userListingCounts', $userListingCounts);
    }

    /**
     * Display selected app user car listings
     */
    public function userListings(User $user): View
    {
        // get all car listings posted by the selected app user
        $listings = $user->userCarListings()->latest()->paginate(12);

        // display/return view
        return view('carListingOwner.index')
            ->with('listings', $listings)
            ->with('carListingOwner', $user);
    }

    /**
     * Delete app user account
     */
    public function deleteUser(User $user): RedirectResponse
    {
        try {
            // delete app user from db
            $user->delete();

            // redirect admin user with success msg
            return back()->with('success', 'User account has been deleted.');
        } catch (\Exception $e) {
            // redirect user with error msg
            return back()->with('error', 'There was an error deleting user account!');
        }
    }
}
