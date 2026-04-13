<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixtureController;

/*
Web Routes
*/

Route::get('/', function () {
    return view('welcome');
});

//  FIXTURES ROUTES (Abdirahman's Part) 

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