<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
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
        return view('admin.index')->with('appUsers', $appUsers)->with('userListingCounts', $userListingCounts);
    }

    /**
     * Delete user account
     */
    public function deleteUser(Request $request): RedirectResponse
    {
        // get app user id
        $user = User::where('id', $request->get('app_user_id'))->first();

        // if error
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'User not found!');
        }

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
