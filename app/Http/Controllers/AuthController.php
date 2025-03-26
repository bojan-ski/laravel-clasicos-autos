<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $newUserData = $request->validate([
            'username' => 'required|string|max:64',
            'email' => 'required|string|email|max:64|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'safe_word' => 'required|string',
        ]);

        $newUserData['password'] = Hash::make($newUserData['password']);

        User::create($newUserData);

        return redirect()->route('login')->with('success', 'Account created. You can login now.');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $userCredentials = $request->validate([
            'email' => 'required|string|email|max:64',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($userCredentials)){
            $request->session()->regenerate();

            return redirect()->route('home.index')->with('success', 'You have logged in');
        }

        return redirect()->back()->withErrors([
            'email' => 'Bad credentials',
            'password' => 'Bad credentials'
        ]);
    }
}
