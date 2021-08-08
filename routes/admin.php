<?php

use App\Http\Controllers\Admin\AnimeAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserAdminController;

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->name('dashboard');*/

Route::group(
	[
		'prefix' => 'dashboard',
		'middleware' => ['auth.admin', 'is_admin'],
	],
	function () {
		Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

		Route::group(
			[
				'prefix' => 'anime',
			],
			function () {
				Route::get('/', [AnimeAdminController::class, 'index'])->name('showAllAnimeAdmin');
				Route::get('/add', [AnimeAdminController::class, 'create'])->name('createAnimeAdmin');
				Route::post('/add', [AnimeAdminController::class, 'store'])->name('storeAnimeAdmin');
				Route::get('/{id}/edit', [AnimeAdminController::class, 'edit'])->name('editAnimeAdmin');
				Route::post('/{id}/update', [AnimeAdminController::class, 'update'])->name('updateAnimeAdmin');
				Route::get('/{id}/delete', [AnimeAdminController::class, 'destroy'])->name('deleteAnimeAdmin');
			}
		);
		Route::group(
			[
				'prefix' => 'category',
			],
			function () {
				Route::get('/', [CategoryAdminController::class, 'index'])->name('showAllCategoryAdmin');
				Route::get('/add', [CategoryAdminController::class, 'create'])->name('addCategoryAdmin');
				Route::post('/add', [CategoryAdminController::class, 'store'])->name('storeCategoryAdmin');
				Route::get('/{id}/edit', [CategoryAdminController::class, 'edit'])->name('editCategoryAdmin');
				Route::post('/{id}/update', [CategoryAdminController::class, 'update'])->name('updateCategoryAdmin');
				Route::get('/{id}/delete', [CategoryAdminController::class, 'destroy'])->name('deleteCategoryAdmin');
			}
		);
		Route::group(
			[
				'prefix' => 'user',
			],
			function () {
				Route::get('/', [UserAdminController::class, 'index'])->name('usersAdmin');
				Route::get('/add', [UserAdminController::class, 'create'])->name('addUserAdmin');
				Route::post('/add', [UserAdminController::class, 'store'])->name('storeUserAdmin');
				Route::get('/{login}/edit', [UserAdminController::class, 'edit'])->name('editUserAdmin');
				Route::post('/{login}/update', [UserAdminController::class, 'update'])->name('updateUserAdmin');
				Route::get('/{login}/delete', [UserAdminController::class, 'destroy'])->name('deleteUserAdmin');
			}
		);
		Route::group(
			[
				'prefix' => 'channel',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'copyright_holder',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'country',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'job',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'kind',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'mpaa',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'news',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'quality',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'studio',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'table_order',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'translate',
			],
			function () {
			}
		);
		Route::group(
			[
				'prefix' => 'year_aired',
			],
			function () {
			}
		);
	}
);