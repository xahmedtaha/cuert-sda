<?php

use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\ProfileController;
use App\Models\InventoryItem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [InventoryItemController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::apiResource('inventoryItems', InventoryItemController::class);
});

require __DIR__.'/auth.php';

Route::get('/DBMigrate', function () {
    if (app()->isProduction()) abort(403);
    Artisan::call('migrate:fresh --seed');
    return 'Database migrated';
});
Route::get('/DBSeed', function () {
    if (app()->isProduction()) abort(403);
    Artisan::call('db:seed');
    return 'Database seeded';
});
