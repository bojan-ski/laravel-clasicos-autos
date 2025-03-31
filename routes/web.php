<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarListingController;

Route::get('/', function () {
    return view('home.index');
})->name('home.index');


Route::get('/listings', [CarListingController::class, 'index'])->name('listings');
Route::get('/listings/search', [CarListingController::class, 'search'])->name('listings.search');
Route::get('/listings/advance_search', [CarListingController::class, 'showAdvanceSearch'])->name('listings.showAdvanceSearch');
Route::get('/listings/filter', [CarListingController::class, 'filter'])->name('listings.filter');
Route::get('/listings/{listing}', [CarListingController::class, 'show'])->name('listings.show');

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

    Route::post('/listings/bookmark/{id}', [CarListingController::class, 'bookmark'])->name('listings.bookmark');
});