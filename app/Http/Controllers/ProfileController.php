<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\CarListing;

class ProfileController extends Controller
{
    /**
     * Display user profile page
     */
    public function index(): View
    {
        $user = Auth::user();

        $userCarListings = CarListing::where('user_id', $user->id)->paginate(8);

        return view('profile.index')->with('user', $user)->with('userCarListings', $userCarListings);
    }

    /**
     * Delete user account
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // verify user/password
        if (!password_verify($request->password, $user->password)) {
            // if wrong password redirect user with error msg
            return redirect()->back()->with('error', 'Password is incorrect, account deletion failed.');
        }

        // if all is good run func
        // delete user from db
        $user->delete();

        // logout user
        Auth::logout();

        // invalidate session
        $request->session()->invalidate();

        // regenerate the csrf token
        $request->session()->regenerateToken();

        // redirect user
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}
