<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProfileController extends Controller
{
    // Methode voor je eigen profiel
    public function index()
    {
        return Inertia::render('profile/index');
    }

    // Methode voor het profiel van iemand anders
    public function show($id)
    {
        // We voegen hier nog de database-logica (het Model) toe
        return Inertia::render('profile/show', [
            'userId' => $id,
        ]);
    }
}
