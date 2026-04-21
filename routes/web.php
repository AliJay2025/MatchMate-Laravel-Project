<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\SimpleRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeagueTableController;

/*
Web Routes
*/

// Simple registration routes (BEFORE auth)
Route::get('/register', [SimpleRegisterController::class, 'showForm']);
Route::post('/register', [SimpleRegisterController::class, 'register']);

// Public routes
Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('/league', [LeagueTableController::class, 'index'])->name('league');
    
    Route::resource('players', PlayerController::class);
    Route::resource('teams', TeamController::class);
    Route::patch('/players/{player}/availability', [PlayerController::class, 'toggleAvailability'])->name('players.availability');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
});

// ========== FIXTURES ROUTES (Abdirahman's Part) ==========

// Public routes - anyone can see
Route::get('/fixtures', [FixtureController::class, 'index'])->name('fixtures.index');
Route::get('/fixtures/{fixture}', [FixtureController::class, 'show'])->name('fixtures.show');

// Protected routes - require login
Route::middleware(['auth'])->group(function () {
    
    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/fixtures/create', [FixtureController::class, 'create'])->name('fixtures.create');
        Route::post('/fixtures', [FixtureController::class, 'store'])->name('fixtures.store');
        Route::delete('/fixtures/{fixture}', [FixtureController::class, 'destroy'])->name('fixtures.destroy');
        Route::post('/fixtures/generate', [FixtureController::class, 'generateFixtures'])->name('fixtures.generate');
        Route::put('/fixtures/{fixture}', [FixtureController::class, 'update'])->name('fixtures.update');
        Route::get('/fixtures/{fixture}/edit', [FixtureController::class, 'edit'])->name('fixtures.edit');
    });
    
    // Manager only routes
    Route::middleware(['role:manager'])->group(function () {
        Route::get('/fixtures/{fixture}/report', [FixtureController::class, 'edit'])->name('fixtures.report');
        Route::post('/fixtures/{fixture}/result', [FixtureController::class, 'storeResult'])->name('fixtures.store-result');
    });
});

// END OF FIXTURES ROUTES