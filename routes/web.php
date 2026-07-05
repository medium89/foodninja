<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/links', [ShortLinkController::class, 'index'])->name('links.index');
    Route::post('/links', [ShortLinkController::class, 'store'])->name('links.store');
    Route::get('/links/{shortLink}', [ShortLinkController::class, 'show'])->name('links.show');
    Route::delete('/links/{shortLink}', [ShortLinkController::class, 'destroy'])->name('links.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{code}', RedirectController::class)
    ->where('code', '[A-Za-z0-9]+')
    ->name('links.redirect');
