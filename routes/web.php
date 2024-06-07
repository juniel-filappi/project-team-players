<?php

use App\Http\Controllers\Players\CreatePlayerController;
use App\Http\Controllers\Players\DeletePlayerController;
use App\Http\Controllers\Players\IndexPlayerController;
use App\Http\Controllers\Players\SortPlayerController;
use App\Http\Controllers\Players\UpdatePlayerController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'players'], function () {
        Route::get('/', IndexPlayerController::class)->name('players.index');
        Route::delete('/{id}', DeletePlayerController::class)->name('players.delete');
        Route::get('/create', [CreatePlayerController::class, 'view'])->name('players.create');
        Route::post('/create', [CreatePlayerController::class, 'store'])->name('players.store');
        Route::get('/edit/{id}', [UpdatePlayerController::class, 'view'])->name('players.edit');
        Route::put('/edit/{id}', [UpdatePlayerController::class, 'update'])->name('players.update');

        Route::post('/sort', SortPlayerController::class)->name('players.sort');
    });
});

require __DIR__.'/auth.php';
