<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// 1. Profielpagina
Route::get('/profiel', function () {
    return Inertia::render('profile/index');
})->name('profile.index');

// 2. Favorietenpagina
Route::get('/favorieten', function () {
    return Inertia::render('favorites/index');
})->name('favorites.index');

// 3. Interesses Overzicht (Grid)
Route::get('/interesses', function () {
    return Inertia::render('interests/index');
})->name('interests.index');

// 4. Opleidingen per Categorie (Lijst)
// We geven de parameter {categorie_id} door aan de React component
Route::get('/interesses/{categorie_id}', function ($categorie_id) {
    return Inertia::render('interests/category', [
        'categoryId' => $categorie_id
    ]);
})->name('interests.category');

// 5. Opleiding Detailpagina
// We geven de parameter {opleiding_id} door aan de React component
Route::get('/opleiding/{opleiding_id}', function ($opleiding_id) {
    return Inertia::render('programs/detail', [
        'programId' => $opleiding_id
    ]);
})->name('programs.detail');
