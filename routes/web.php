<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CarListingOwnerController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ProfileController;

// home page - app & admin user
Route::get('/', function () {
    return view('home.index');
})->name('home.index');

// car listings - app & admin user
Route::get('/listings', [CarListingController::class, 'index'])->name('listings');
Route::get('/listings/search', [SearchController::class, 'search'])->name('listings.search');
Route::get('/listings/advance_search', [SearchController::class, 'showAdvanceSearch'])->name('listings.showAdvanceSearch');
Route::get('/listings/filter', [SearchController::class, 'filter'])->name('listings.filter');
Route::get('/listings/create', [CarListingController::class, 'create'])->name('listings.create')->middleware('auth');
Route::post('/listings/store', [CarListingController::class, 'store'])->name('listings.store')->middleware('auth');
Route::get('/listings/{listing}', [CarListingController::class, 'show'])->name('listings.show');
Route::get('/listings/edit/{listing}', [CarListingController::class, 'edit'])->name('listings.edit');
Route::put('/listings/update/{listing}', [CarListingController::class, 'update'])->name('listings.update');
Route::delete('/listings/destroy/{listing}', [CarListingController::class, 'destroy'])->name('listings.destroy');

// compare car listings - app & admin user
Route::get('/compare', [CompareController::class, 'showCompare'])->name('compare.show');
Route::get('/compare/clear', [CompareController::class, 'clearCompare'])->name('compare.clear');
Route::post('/compare/add/{listing}', [CompareController::class, 'addToCompare'])->name('compare.add');
Route::post('/compare/remove/{listing}', [CompareController::class, 'removeFromCompare'])->name('compare.remove');

// car listing owner - app & admin user
Route::get('/listing_owner', [CarListingOwnerController::class, 'index'])->name('listingOwner.index');

// legal - app & admin user
Route::get('/privacy_policy', [LegalController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms_and_conditions', [LegalController::class, 'termsAndConditions'])->name('termsAndConditions');

// auth - app & admin user
Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::put('/forgot_password', [AuthController::class, 'resetPassword'])->name('forgotPassword.resetPassword');
});

Route::middleware('auth')->group(function(){
    // auth - app & admin user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // bookmark car listings - app & admin user
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');
    Route::delete('/bookmarks/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');

    // app user profile - app user
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update_safe_word', [ProfileController::class, 'updateSafeWord'])->name('profile.updateSafeWord');
    Route::put('/profile/update_password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});