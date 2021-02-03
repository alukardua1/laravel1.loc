<?php

use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->name('dashboard');