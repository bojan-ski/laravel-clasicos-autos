<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display user profile page
     */
    public function index(): View
    {
        // get user profile data
        $user = Auth::user();

        // get user posted car listings from database
        $userCarListings = $user->userCarListings()->latest()->paginate(8);

        return view('profile.index')->with('user', $user)->with('userCarListings', $userCarListings);
    }

    /**
     * Update user safe word
     */
    public function updateSafeWord(Request $request): RedirectResponse
    {
        // check user provided data
        $formData = $request->validate([
            'old_safe_word' => 'required|string|max:20',
            'new_safe_word' => 'required|string|max:20|different:old_safe_word',
            'confirm_safe_word' => 'required|string|max:20|same:new_safe_word'
        ]);

        // get user profile data
        $user = Auth::user();

        // check if provided safe word is related to the user
        if ($user->safe_word !== $formData['old_safe_word']) {
            return redirect()->back()->withErrors([
                'old_safe_word' => 'Invalid safe word'
            ]);
        };

        // if all is good - change safe word
        try {
            $user->safe_word = $formData['new_safe_word'];
            $user->save();

            // redirect user - with success msg
            return back()->with('success', 'Safe word updated.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error while updating the safe word!');
        }
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        // check user provided data
        $formData = $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:6|different:old_password|confirmed'
        ]);

        // get user profile data
        $user = Auth::user();

        // check if provided password is related to the user
        if (!Hash::check($formData['old_password'], $user->password)) {
            return redirect()->back()->withErrors([
                'old_password' => 'Invalid password'
            ]);
        };

        // if all is good - change password
        try {
            $user->password = Hash::make($formData['password']);
            $user->save();

            // redirect user - with success msg
            return back()->with('success', 'Password updated');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error while updating the password!');
        }
    }

    /**
     * Delete user account
     */
    public function destroy(Request $request): RedirectResponse
    {
        // get user profile data
        $user = Auth::user();

        // verify user/password
        if (!password_verify($request->password, $user->password)) return back()->with('error', 'Password is incorrect, account deletion failed.');

        // if all is good delete account
        try {
            // delete user from db
            $user->delete();

            // logout user
            Auth::logout();

            // invalidate session
            $request->session()->invalidate();

            // regenerate the csrf token
            $request->session()->regenerateToken();

            // redirect user - with success msg
            return redirect('/')->with('success', 'Your account has been deleted.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error while deleting your account!');
        }
    }
}
