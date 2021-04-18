<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Admin\AnimeAdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\MPAARatingController;
use App\Http\Controllers\ParseDbDLEController;
use App\Http\Controllers\PersonalMessageController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TableOrderController;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\YearAiredController;
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
Route::get('/dle/{id?}', [ParseDbDLEController::class, 'index']);
Route::get('/', [AnimeController::class, 'index'])->name('home');

Route::group(
	['prefix' => 'anime'],
	function () {
		Route::get('/', [AnimeController::class, 'index'])->name('animeAll');
		Route::get('/{id}-{url?}', [AnimeController::class, 'show'])->name('showAnime')->where('id', '[0-9]+');
		Route::get('/rss', [AnimeController::class, 'animeRss'])->name('animeRss');
		Route::post('/{id}/addComment', [AnimeController::class, 'setComments'])->name('addCommentAnime')->middleware('auth');
		Route::get('/{id}/delComment/{comment}/{fullDel?}', [AnimeController::class, 'deleteComments'])->name('delComments')->middleware('auth');
	}
);

Route::group(
	[],
	function () {
		Route::get('channel/{custom}', [ChannelController::class, 'index'])->name('channel');
		Route::get('studio/{custom}', [StudioController::class, 'index'])->name('studio');
		Route::get('quality/{custom}', [QualityController::class, 'index'])->name('quality');
		Route::get('kind/{custom}', [KindController::class, 'index'])->name('kind');
		Route::get('country/{custom}', [CountryController::class, 'index'])->name('country');
		Route::get('translate/{custom}', [TranslateController::class, 'index'])->name('translate');
		Route::get('rating/{custom}', [MPAARatingController::class, 'index'])->name('rating');
		Route::get('year/{custom}', [YearAiredController::class, 'index'])->name('year');
		Route::get('ongoing', [AnimeController::class, 'indexOngoing'])->name('ongoing');
		Route::get('search', [AnimeController::class, 'search'])->name('search');
		Route::get('searchAdmin', [AnimeAdminController::class, 'search'])->name('searchAdmin');
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
	[
		'prefix'     => 'order',
		'middleware' => ['auth'],
	],
	function () {
		Route::get('/', [TableOrderController::class, 'index'])->name('tableOrder');
		Route::get('/{id}/edit', [TableOrderController::class, 'edit'])->name('tableOrderEdit')->middleware('is_admin');
		Route::get('/add', [TableOrderController::class, 'create'])->name('tableOrderAdd');
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
		Route::get('/{login}/PM', [PersonalMessageController::class, 'index'])->name('PM');
		Route::get('/{login}/anime', [UserController::class, 'showAnime'])->name('currentUserAnime');
		Route::get('/{login}/rss', [UserController::class, 'userRss'])->name('currentUserRss');
		Route::post('/{login}', [UserController::class, 'update'])->name('currentUserUpdate');
		Route::get('/{login}/comments', [UserController::class, 'showComment'])->name('currentUserComments');
	}
);
Route::post('/favorites_add/{id}', [FavoritesController::class, 'add'])->name('favorite_add')->middleware('auth');
Route::post('/favorites_del/{id}', [FavoritesController::class, 'delete'])->name('favorite_del')->middleware('auth');
Route::post('/plus/{id}', [VoteController::class, 'plus'])->name('votes_plus')->middleware('auth');
Route::post('/minus/{id}', [VoteController::class, 'minus'])->name('votes_minus')->middleware('auth');

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
		Route::get('/{category}', [CategoryController::class, 'index'])->name('currentCategory');
	}
);
Auth::routes();
