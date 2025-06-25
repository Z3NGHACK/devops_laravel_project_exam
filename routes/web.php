<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    // Terrains
    Route::resource('terrains', TerrainController::class);

    // Bookings
    Route::resource('bookings', BookingController::class)->except(['create']);
    Route::get('terrains/{terrain}/bookings/create', [BookingController::class, 'create'])
        ->name('bookings.create');

    // Payments
    Route::resource('payments', PaymentController::class);

    // Reviews
    Route::resource('reviews', ReviewController::class);

    // Favorites
    Route::resource('favorites', FavoriteController::class)->only(['index', 'store', 'destroy']);
    Route::post('terrains/{terrain}/favorites', [FavoriteController::class, 'toggle'])
        ->name('favorites.toggle');
});

require __DIR__.'/auth.php';
