<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'message' => 'Welcome to your Inertia + React app.',
    ]);
});

require __DIR__ . '/category.php';
