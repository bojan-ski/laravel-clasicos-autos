<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\CarListing;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    // Display user profile page
    public function index(): View
    {
        $user = Auth::user();

        $userCarListings = CarListing::where('user_id', $user->id)->paginate(12);

        return view('profile.index')->with('user', $user)->with('userCarListings', $userCarListings);
    }
    
    // Display user profile page
    public function destroy()
    {
        
    }
}
