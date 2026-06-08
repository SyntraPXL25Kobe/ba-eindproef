<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// Favorietenpagina
Route::get('/favorieten', function () {
    return Inertia::render('favorites/index');
})->name('favorites.index');

// Interesses Overzicht (Grid)
Route::get('/interesses', function () {
    return Inertia::render('interests/index');
})->name('interests.index');

// Opleidingen per Categorie (Lijst)
// We geven de parameter {categorie_id} door aan de React component
Route::get('/interesses/{categorie_id}', function ($categorie_id) {
    return Inertia::render('interests/category', [
        'categoryId' => $categorie_id,
    ]);
})->name('interests.category');

// Opleiding Detailpagina
// We geven de parameter {opleiding_id} door aan de React component
Route::get('/opleiding/{opleiding_id}', function ($opleiding_id) {
    return Inertia::render('programs/detail', [
        'programId' => $opleiding_id,
    ]);
})->name('programs.detail');

// Route voor een specifiek profiel (Ander profiel)
Route::get('/profiel/{id}', [ProfileController::class, 'show'])->name('profile.show');

// --- Evenementen ---

// Overzichtspagina van alle evenementen
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Detailpagina van een specifiek evenement
Route::get('/events/{id}', function ($id) {
    return Inertia::render('events/show', [
        'eventId' => $id,
    ]);
})->name('events.show');

// --- Bedrijven ---

// Overzichtspagina van alle bedrijven
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

// Detailpagina van een specifiek bedrijf
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
