<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginAdminController;

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->name('dashboard');*/

Route::group(
	['prefix' => 'dashboard'],
	function () {
		Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth.admin');
	});


Route::get('login', [LoginAdminController::class, 'showLoginForm'])->name('loginAdmin');
Route::post('login', [LoginAdminController::class, 'login']);