<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/dle/{id}', [\App\Http\Controllers\ParseDbDLEController::class, 'index']);
Route::get('/', [AnimeController::class, 'index'])->name('home');

Route::group(
	['prefix' => 'anime'],
	function () {
		Route::get('/', [AnimeController::class, 'index'])->name('animeAll');
		Route::get('/{id}-{url?}', [AnimeController::class, 'show'])->name('showAnime');
	}
);

Route::group(
	['prefix'=>'custom'],
	function () {
		Route::get('/{custom}')->name('custom');
	}
);

Route::group(
	['prefix' => 'news'],
	function () {
	}
);

Route::group(
	['prefix' => 'blog'],
	function () {
	}
);

Route::group(
	['prefix' => 'user'],
	function () {
		Route::get('/', [UserController::class, 'index'])->name('users');
		Route::get('/{login}', [UserController::class, 'show'])->name('currentUser');
		Route::get('/{login}/edit', [UserController::class, 'edit'])->name('editUser');
		Route::get('/{login}/update', [UserController::class, 'update'])->name('updateUser');
		Route::get('/{login}/favorite', [FavoritesController::class, 'index'])->name('favorite');
	}
);
Route::post('/favorites_add/{id}', [FavoritesController::class, 'add'])->name('favorite_add')->middleware('auth');
Route::post('/favorites_del/{id}', [FavoritesController::class, 'delete'])->name('favorite_del')->middleware('auth');

Route::group(
	['prefix' => 'team'],
	function () {
		Route::get('/', [])->name('team');
		Route::get('/{team}', [])->name('currentTeam');
		Route::get('/add', [])->name('addUserTeam');
		Route::get('/create', [])->name('createTeam');
		Route::get('/remove', [])->name('removeUserTeam');
		Route::get('/delete', [])->name('deleteTeam');
		Route::get('/update', [])->name('updateTeam');
	}
);

Route::group(
	['prefix' => 'category'],
	function () {
		Route::get('/{category}', [CategoryController::class, 'show'])->name('currentCategory');
	}
);
Auth::routes();
