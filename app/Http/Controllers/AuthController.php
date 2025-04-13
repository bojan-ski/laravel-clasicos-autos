<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Display user register user page
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Create user account
     */
    public function store(Request $request): RedirectResponse
    {
        // check new user data
        $newUserData = $request->validate([
            'username' => 'required|string|max:64',
            'email' => 'required|string|email|max:64|unique:users',
            'phone_number' => 'required|string|max:20|regex:/^[0-9\+\-\(\)\/\s]*$/',
            'password' => 'required|string|min:6|confirmed',
            'safe_word' => 'required|string|max:20',
            'terms_and_conditions' => 'required|accepted',
            'privacy_policy' => 'required|accepted',
        ]);

        // hash password
        $newUserData['password'] = Hash::make($newUserData['password']);

        // create new user in db
        User::create($newUserData);

        // redirect user
        return redirect()->route('login')->with('success', 'Account created. You can login now.');
    }

    /**
     * Display user login page
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Authenticate user
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // check user provided credentials
        $userCredentials = $request->validate([
            'email' => 'required|string|email|max:64',
            'password' => 'required|string'
        ]);

        // if all is good - login user
        if (Auth::attempt($userCredentials)) {
            $request->session()->regenerate();

            return redirect()->route('profile.index')->with('success', 'You have logged in');
        }

        // if bad credentials - redirect user
        return redirect()->back()->withErrors([
            'email' => 'Bad credentials',
            'password' => 'Bad credentials'
        ]);
    }

    /**
     * Display user forgot password page
     */
    public function forgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Reset user password
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        // check user provided data
        $userCredentials = $request->validate([
            'email' => 'required|string|email|max:64|exists:users,email',
            'safe_word' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // check if user exists
        $user = User::where('email', $userCredentials['email'])->first();

        // check if provided safe word is related to the provided email
        if (!$user || $user->safe_word !== $userCredentials['safe_word']) {
            return redirect()->back()->withErrors([
                'email' => 'Bad credentials',
                'safe_word' => 'Bad credentials'
            ]);
        };

        // if all is good - updated password
        $user->password = Hash::make($userCredentials['password']);
        $user->save();

        // redirect user
        return redirect()->route('login')->with('success', 'Account created. You can login now.');
    }

    /**
     * Logout user
     */
    public function logout(Request $request): RedirectResponse
    {
        // logout user
        Auth::logout();

        // invalidate session
        $request->session()->invalidate();

        // regenerate the csrf token
        $request->session()->regenerateToken();

        // redirect user
        return redirect()->route('home.index')->with('success', 'You have logged out!');
    }
}
