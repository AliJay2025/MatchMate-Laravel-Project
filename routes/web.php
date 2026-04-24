<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\SimpleRegisterController;
use Illuminate\Support\Facades\Route;

// Simple registration routes (BEFORE auth)
Route::get('/register', [SimpleRegisterController::class, 'showForm']);
Route::post('/register', [SimpleRegisterController::class, 'register']);
Route::get('/fixtures', [App\Http\Controllers\FixtureController::class, 'index'])->name('fixtures');

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/fixtures', [App\Http\Controllers\FixtureController::class, 'index'])->name('fixtures');

// Auth routes (includes /login and /register)
require __DIR__.'/auth.php';

// Protected routes (require authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/league', [App\Http\Controllers\LeagueTableController::class, 'index'])->name('league');

    Route::get('/fixtures', [App\Http\Controllers\FixtureController::class, 'index'])->name('fixtures');
    
    // Fixtures routes (resource already includes index, create, store, edit, update, destroy)
    Route::resource('fixtures', App\Http\Controllers\FixtureController::class);
    
    Route::resource('players', PlayerController::class);
    Route::resource('teams', App\Http\Controllers\TeamController::class);
    Route::patch('/players/{player}/availability', [PlayerController::class, 'toggleAvailability'])->name('players.availability');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
});