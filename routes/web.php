<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home.index');
})->name('home.index');

Route::get('/listings', [CarListingController::class, 'index'])->name('listings');
Route::get('/listings/search', [SearchController::class, 'search'])->name('listings.search');
Route::get('/listings/advance_search', [SearchController::class, 'showAdvanceSearch'])->name('listings.showAdvanceSearch');
Route::get('/listings/filter', [SearchController::class, 'filter'])->name('listings.filter');
Route::get('/listings/{listing}', [CarListingController::class, 'show'])->name('listings.show');

Route::get('/compare', [CompareController::class, 'showCompare'])->name('compare.show');
Route::get('/compare/clear', [CompareController::class, 'clearCompare'])->name('compare.clear');
Route::post('/compare/add/{listing}', [CompareController::class, 'addToCompare'])->name('compare.add');
Route::post('/compare/remove/{listing}', [CompareController::class, 'removeFromCompare'])->name('compare.remove');

Route::get('/privacy_policy', [LegalController::class, 'privacyPolicy'])->name('privacy_policy');
Route::get('/terms_and_conditions', [LegalController::class, 'termsAndConditions'])->name('terms_and_conditions');

Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::put('/forgot-password', [AuthController::class, 'resetPassword'])->name('forgot-password.update');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');
    Route::delete('/bookmarks/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});