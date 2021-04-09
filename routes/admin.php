<?php

use App\Http\Controllers\Admin\AnimeAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\DashboardController;

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->name('dashboard');*/

Route::group(
	[
		'prefix'     => 'dashboard',
		'middleware' => ['auth.admin', 'is_admin'],
	],
	function () {
		Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
		Route::get('/anime', [AnimeAdminController::class, 'index'])->name('showAllAnimeAdmin');
		Route::get('/anime/add', [AnimeAdminController::class, 'create'])->name('createAnimeAdmin');
		Route::get('/anime/{id}/edit', [AnimeAdminController::class, 'edit'])->name('editAnimeAdmin');
		Route::post('/anime/{id}/update', [AnimeAdminController::class, 'update'])->name('updateAnimeAdmin');

		Route::get('/category', [CategoryAdminController::class, 'index'])->name('showAllCategoryAdmin');
		Route::get('/category/{id}/edit', [CategoryAdminController::class, 'edit'])->name('editCategoryAdmin');

	}
);