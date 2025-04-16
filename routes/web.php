<?php

use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CarListingImagesController;
use App\Http\Controllers\CarListingOwnerController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home.index');
})->name('home.index');

Route::prefix('listings')->group(function () {
    Route::get('/', [CarListingController::class, 'index'])->name('listings');
    Route::get('/search', [SearchController::class, 'search'])->name('listings.search');
    Route::get('/advance_search', [SearchController::class, 'showAdvanceSearch'])->name('listings.showAdvanceSearch');
    Route::get('/filter', [SearchController::class, 'filter'])->name('listings.filter');

    Route::middleware('auth')->group(function () {
        Route::get('/create', [CarListingController::class, 'create'])->name('listings.create');
        Route::post('/store', [CarListingController::class, 'store'])->name('listings.store');
        
        Route::get('/edit/{listing}', [CarListingController::class, 'edit'])->name('listings.edit');
        Route::put('/update/{listing}', [CarListingController::class, 'update'])->name('listings.update');
    
        Route::get('/edit_images/{listing}', [CarListingImagesController::class, 'editImages'])->name('listings.editImages');
        Route::post('/set_as_primary_image/{listing}', [CarListingImagesController::class, 'setAsPrimaryImage'])->name('listings.setAsPrimaryImage');
        Route::delete('/destroy_image/{listing}', [CarListingImagesController::class, 'destroyImage'])->name('listings.destroyImage');
        Route::post('/add_new_images/{listing}', [CarListingImagesController::class, 'addNewImages'])->name('listings.addNewImages');
    
        Route::delete('/destroy/{listing}', [CarListingController::class, 'destroy'])->name('listings.destroy');
    });

    Route::get('/{listing}', [CarListingController::class, 'show'])->name('listings.show');
});

Route::get('/compare', [CompareController::class, 'showCompare'])->name('compare.show');
Route::get('/compare/clear', [CompareController::class, 'clearCompare'])->name('compare.clear');
Route::post('/compare/add/{listing}', [CompareController::class, 'addToCompare'])->name('compare.add');
Route::post('/compare/remove/{listing}', [CompareController::class, 'removeFromCompare'])->name('compare.remove');

Route::get('/listing_owner', [CarListingOwnerController::class, 'index'])->name('listingOwner.index');

Route::get('/privacy_policy', [LegalController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms_and_conditions', [LegalController::class, 'termsAndConditions'])->name('termsAndConditions');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::put('/forgot_password', [AuthController::class, 'resetPassword'])->name('forgotPassword.resetPassword');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');
    Route::delete('/bookmarks/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');

    // app user only 
    Route::middleware(\App\Http\Middleware\AppUserMiddleware::class)->group(function (){
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update_safe_word', [ProfileController::class, 'updateSafeWord'])->name('profile.updateSafeWord');
        Route::put('/profile/update_password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // admin user only
    Route::middleware(\App\Http\Middleware\AdminUserMiddleware::class)->group(function (){
        Route::get('/app_users', [AdminUserController::class, 'index'])->name('admin.index');
        Route::get('/app_users/search', [AdminUserController::class, 'search'])->name('admin.search');
        Route::get('/app_users/{user}', [AdminUserController::class, 'userListings'])->name('admin.userListings');
        Route::delete('/delete_user', [AdminUserController::class, 'deleteUser'])->name('admin.deleteUser');
    });
});
