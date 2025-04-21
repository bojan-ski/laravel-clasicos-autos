<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CarListingImagesController;
use App\Http\Controllers\CarListingOwnerController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;

// home
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// listings feature
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

// compare feature
Route::prefix('compare')->group(function () {
    Route::get('/', [CompareController::class, 'showCompare'])->name('compare.show');
    Route::get('/clear', [CompareController::class, 'clearCompare'])->name('compare.clear');
    Route::post('/add/{listing}', [CompareController::class, 'addToCompare'])->name('compare.add');
    Route::post('/remove/{listing}', [CompareController::class, 'removeFromCompare'])->name('compare.remove');
});

// see listing owner feature
Route::get('/listing_owner', [CarListingOwnerController::class, 'index'])->name('listingOwner.index');

// GUEST ONLY
Route::middleware('guest')->group(function () {
    // auth features
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::put('/forgot_password', [AuthController::class, 'resetPassword'])->name('forgotPassword.resetPassword');
});

// legal features
Route::get('/privacy_policy', [LegalController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/terms_and_conditions', [LegalController::class, 'termsAndConditions'])->name('termsAndConditions');

// AUTH ONLY
Route::middleware('auth')->group(function () {
    // auth - logout feature
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // bookmark feature
    Route::prefix('bookmarks')->group(function () {
        Route::get('/', [BookmarkController::class, 'index'])->name('bookmarks.index');
        Route::post('/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');
        Route::delete('/{listing}', [BookmarkController::class, 'bookmark'])->name('listings.bookmark');
    });

    // conversation feature
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/{conversation}', [MessageController::class, 'index'])->name('conversations.show');
    Route::post('/conversations/{conversation}/store', [MessageController::class, 'store'])->name('conversations.store');
    Route::delete('/messages/{message}/destroy', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('/listings/{listing}/message/{receiverId}', [ConversationController::class, 'conversationThread'])->name('conversations.thread');    
    Route::get('/new_messages', [MessageController::class, 'newMessage'])->name('messages.newMessage');

    // APP USER ONLY
    Route::middleware(\App\Http\Middleware\AppUserMiddleware::class)->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update_safe_word', [ProfileController::class, 'updateSafeWord'])->name('profile.updateSafeWord');
        Route::put('/profile/update_password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // ADMIN USER ONLY
    Route::middleware(\App\Http\Middleware\AdminUserMiddleware::class)->group(function () {
        Route::get('/app_users', [AdminUserController::class, 'index'])->name('admin.index');
        Route::get('/app_users/search', [AdminUserController::class, 'search'])->name('admin.search');
        Route::get('/app_users/{user}', [AdminUserController::class, 'userListings'])->name('admin.userListings');
        Route::delete('/delete_user', [AdminUserController::class, 'deleteUser'])->name('admin.deleteUser');
    });
});
