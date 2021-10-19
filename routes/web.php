<?php

use App\Http\Controllers\Admin\AnimeAdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\MPAARatingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ParseDbDLEController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PersonalMessageController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\StaticPageController;
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

Route::get('/dle/{id?}', [ParseDbDLEController::class, 'index']);
Route::get('/', [AnimeController::class, 'index'])->name('home');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('sendFeedback');

Route::group(
	['prefix' => 'faq'],
	function () {
		Route::get('/', [FaqController::class, 'index'])->name('faqAll');
		Route::get('/{faq}', [FaqController::class, 'show'])->name('faqShow');
	}
);

Route::group(
	['prefix' => 'static_page'],
	function () {
		Route::get('/', [StaticPageController::class, 'index'])->name('static_pageAll');
		Route::get('/{static_page}', [StaticPageController::class, 'show'])->name('static_pageShow');
	}
);

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
		Route::get('channel/{custom}', [ChannelController::class, 'show'])->name('channel');
		Route::get('studio/{custom}', [StudioController::class, 'show'])->name('studio');
		Route::get('quality/{custom}', [QualityController::class, 'show'])->name('quality');
		Route::get('kind/{custom}', [KindController::class, 'show'])->name('kind');
		Route::get('country/{custom}', [CountryController::class, 'show'])->name('country');
		Route::get('translate/{custom}', [TranslateController::class, 'show'])->name('translate');
		Route::get('rating/{custom}', [MPAARatingController::class, 'show'])->name('rating');
		Route::get('year/{custom}', [YearAiredController::class, 'show'])->name('year');
		Route::get('ongoing', [AnimeController::class, 'indexOngoing'])->name('ongoing');
		Route::get('search', [AnimeController::class, 'search'])->name('search');
		Route::get('searchAdmin', [AnimeAdminController::class, 'search'])->name('searchAdmin');
	}
);

Route::group(
	['prefix' => 'news'],
	function () {
		Route::get('/', [NewsController::class, 'index'])->name('newsAll');
		Route::get('/{id}-{url?}', [NewsController::class, 'show'])->name('showNews')->where('id', '[0-9]+');
	}
);

Route::group(
	['prefix' => 'blog'],
	function () {
	}
);

Route::group(
	[
		'prefix' => 'order',
		'middleware' => ['auth'],
	],
	function () {
		Route::get('/', [TableOrderController::class, 'index'])->name('tableOrder');
		Route::get('/{id}', [TableOrderController::class, 'show'])->name('tableOrderShow')->where('id', '[0-9]+');
		Route::get('/{id}/edit', [TableOrderController::class, 'edit'])->name('tableOrderEdit')->middleware('is_admin')->where('id', '[0-9]+');
		Route::post('/{id}/update', [TableOrderController::class, 'update'])->name('tableOrderUpdate')->where('id', '[0-9]+');
		Route::get('/add', [TableOrderController::class, 'create'])->name('tableOrderAdd');
		Route::post('/add', [TableOrderController::class, 'store'])->name('tableOrderStore');
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
		Route::get('/{category}', [CategoryController::class, 'show'])->name('currentCategory');
	}
);
Route::group(
	['prefix' => 'people'],
	function () {
		Route::get('/', [PeopleController::class, 'index'])->name('people');
		Route::get('/{people}', [PeopleController::class, 'show'])->name('showPeople');
	}
);

Auth::routes();
