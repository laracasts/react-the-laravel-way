<?php

use App\Http\Controllers\PuppyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PuppyController::class, 'index'])->name('home');

// Logged-in routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::patch('puppies/{puppy}/like', [PuppyController::class, 'like'])
        ->name('puppies.like');
    Route::post('puppies', [PuppyController::class, 'store'])
        ->name('puppies.store');
    Route::put('puppies/{puppy}', [PuppyController::class, 'update'])
        ->name('puppies.update');
    Route::delete('puppies/{puppy}', [PuppyController::class, 'destroy'])
        ->name('puppies.destroy');

    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/settings.php';
