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
		Route::post('/anime/add', [AnimeAdminController::class, 'store'])->name('storeAnimeAdmin');
		Route::get('/anime/{id}/edit', [AnimeAdminController::class, 'edit'])->name('editAnimeAdmin');
		Route::post('/anime/{id}/update', [AnimeAdminController::class, 'update'])->name('updateAnimeAdmin');
		Route::get('/anime/{id}/delete', [AnimeAdminController::class, 'destroy'])->name('deleteAnimeAdmin');

		Route::get('/category', [CategoryAdminController::class, 'index'])->name('showAllCategoryAdmin');
		Route::get('/category/add', [CategoryAdminController::class, 'create'])->name('addCategoryAdmin');
		Route::post('/category/add', [CategoryAdminController::class, 'store'])->name('storeCategoryAdmin');
		Route::get('/category/{id}/edit', [CategoryAdminController::class, 'edit'])->name('editCategoryAdmin');
		Route::post('/category/{id}/update', [CategoryAdminController::class, 'update'])->name('updateCategoryAdmin');
		Route::get('/category/{id}/delete', [CategoryAdminController::class, 'destroy'])->name('deleteCategoryAdmin');

	}
);