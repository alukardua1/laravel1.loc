<?php

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
Route::get('/feedback', [FeedbackController::class, 'index'])->name('indexFeedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('storeFeedback');

Route::group(
	['prefix' => 'faq'],
	function () {
		Route::get('/', [FaqController::class, 'index'])->name('indexFaq');
		Route::get('/{faq}', [FaqController::class, 'show'])->name('showFaq');
	}
);

Route::group(
	['prefix' => 'page'],
	function () {
		Route::get('/', [StaticPageController::class, 'index'])->name('indexStaticPage');
		Route::get('/{page}', [StaticPageController::class, 'show'])->name('showStaticPage');
	}
);

Route::group(
	['prefix' => 'anime'],
	function () {
		Route::get('/', [AnimeController::class, 'index'])->name('indexAnime');
		Route::get('/{id}-{url?}', [AnimeController::class, 'show'])->name('showAnime')->where('id', '[0-9]+');
		Route::get('/rss', [AnimeController::class, 'animeRss'])->name('animeRss');
		Route::post('/{id}/addComment', [AnimeController::class, 'setComments'])->name('addCommentAnime')->middleware('auth');
		Route::get('/{id}/delComment/{comment}/{fullDel?}', [AnimeController::class, 'deleteComments'])->name('delComments')->middleware('auth');
	}
);

Route::group(
	[],
	function () {
		Route::get('channel/{custom}', [ChannelController::class, 'show'])->name('showChannel');
		Route::get('studio/{custom}', [StudioController::class, 'show'])->name('showStudio');
		Route::get('quality/{custom}', [QualityController::class, 'show'])->name('showQuality');
		Route::get('kind/{custom}', [KindController::class, 'show'])->name('showKind');
		Route::get('country/{custom}', [CountryController::class, 'show'])->name('showCountry');
		Route::get('translate/{custom}', [TranslateController::class, 'show'])->name('showTranslate');
		Route::get('rating/{custom}', [MPAARatingController::class, 'show'])->name('showRating');
		Route::get('year/{custom}', [YearAiredController::class, 'show'])->name('showYear');
		Route::get('ongoing', [AnimeController::class, 'indexOngoing'])->name('ongoing');
		Route::get('anons', [AnimeController::class, 'indexAnons'])->name('anons');
		Route::get('search', [AnimeController::class, 'search'])->name('search');
		Route::get('search', [AnimeController::class, 'doSearch'])->name('doSearch');
	}
);

Route::group(
	['prefix' => 'news'],
	function () {
		Route::get('/', [NewsController::class, 'index'])->name('indexNews');
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
		Route::get('/', [TableOrderController::class, 'index'])->name('indexTableOrder');
		Route::get('/{id}', [TableOrderController::class, 'show'])->name('showTableOrder')->where('id', '[0-9]+');
		Route::get('/{id}/edit', [TableOrderController::class, 'edit'])->name('editTableOrder')->middleware('is_admin')->where('id', '[0-9]+');
		Route::post('/{id}/update', [TableOrderController::class, 'update'])->name('updateTableOrder')->where('id', '[0-9]+');
		Route::get('/add', [TableOrderController::class, 'create'])->name('createTableOrder');
		Route::post('/add', [TableOrderController::class, 'store'])->name('storeTableOrder');
	}
);

Route::group(
	['prefix' => 'user'],
	function () {
		Route::get('/', [UserController::class, 'index'])->name('indexUsers');
		Route::get('/{login}', [UserController::class, 'show'])->name('showUser');
		Route::get('/{login}/edit', [UserController::class, 'edit'])->name('editUser');
		Route::post('/{login}/update', [UserController::class, 'update'])->name('updateUser');
		Route::get('/{login}/favorite', [FavoritesController::class, 'index'])->name('indexFavorite');
		Route::get('/{login}/PM', [PersonalMessageController::class, 'index'])->name('indexPM');
		Route::get('/{login}/anime', [UserController::class, 'showAnime'])->name('showUserAnime');
		Route::get('/{login}/rss', [UserController::class, 'userRss'])->name('showUserRss');
		Route::get('/{login}/comments', [UserController::class, 'showComment'])->name('showUserComments');
	}
);
Route::post('/favorites_add/{id}', [FavoritesController::class, 'add'])->name('favorite_add')->middleware('auth');
Route::post('/favorites_del/{id}', [FavoritesController::class, 'delete'])->name('favorite_del')->middleware('auth');
Route::post('/plus/{id}', [VoteController::class, 'plus'])->name('votes_plus')->middleware('auth');
Route::post('/minus/{id}', [VoteController::class, 'minus'])->name('votes_minus')->middleware('auth');

Route::group(
	['prefix' => 'team'],
	function () {
		Route::get('/', [])->name('indexTeam');
		Route::get('/{team}', [])->name('showTeam');
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
		Route::get('/{category}', [CategoryController::class, 'show'])->name('showCategory');
	}
);
Route::group(
	['prefix' => 'people'],
	function () {
		Route::get('/', [PeopleController::class, 'index'])->name('indexPeople');
		Route::get('/{people}', [PeopleController::class, 'show'])->name('showPeople');
	}
);

Auth::routes();
