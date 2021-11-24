<?php

use App\Http\Controllers\Admin\AnimeAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ChannelAdminController;
use App\Http\Controllers\Admin\CopyrightHolderAdminController;
use App\Http\Controllers\Admin\CountryAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\GroupAdminController;
use App\Http\Controllers\Admin\JobPeopleAdminController;
use App\Http\Controllers\Admin\KindAdminController;
use App\Http\Controllers\Admin\KodikAdminController;
use App\Http\Controllers\Admin\MPAAAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\PeopleAdminController;
use App\Http\Controllers\Admin\QualityAdminController;
use App\Http\Controllers\Admin\StaticPageAdminController;
use App\Http\Controllers\Admin\StudioAdminController;
use App\Http\Controllers\Admin\TableOrderAdminController;
use App\Http\Controllers\Admin\TranslateAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\YearAiredAdminController;

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
			['prefix' => 'kodik'],
			function () {
				Route::get('/{category?}/{page?}', [KodikAdminController::class, 'index'])->name('kodikBaseList');
				Route::get('/{options?}/{search?}', [KodikAdminController::class, 'search'])->name('kodikBaseSearch');
			}
		);

		Route::group(
			['prefix' => 'anime',],
			function () {
				Route::get('/', [AnimeAdminController::class, 'index'])->name('indexAnimeAdmin');
				Route::get('/add', [AnimeAdminController::class, 'create'])->name('createAnimeAdmin');
				Route::post('/add', [AnimeAdminController::class, 'store'])->name('storeAnimeAdmin');
				Route::get('/{id}/edit', [AnimeAdminController::class, 'edit'])->name('editAnimeAdmin');
				Route::post('/{id}/update', [AnimeAdminController::class, 'update'])->name('updateAnimeAdmin');
				Route::get('/{id}/delete', [AnimeAdminController::class, 'destroy'])->name('deleteAnimeAdmin');
				Route::get('/searchAnimeAdmin', [AnimeAdminController::class, 'search'])->name('searchAnimeAdmin');
			}
		);
		Route::group(
			['prefix' => 'category',],
			function () {
				Route::get('/', [CategoryAdminController::class, 'index'])->name('indexCategoryAdmin');
				Route::get('/add', [CategoryAdminController::class, 'create'])->name('createCategoryAdmin');
				Route::post('/add', [CategoryAdminController::class, 'store'])->name('storeCategoryAdmin');
				Route::get('/{category}/edit', [CategoryAdminController::class, 'edit'])->name('editCategoryAdmin');
				Route::post('/{category}/update', [CategoryAdminController::class, 'update'])->name('updateCategoryAdmin');
				Route::get('/{category}/delete', [CategoryAdminController::class, 'destroy'])->name('deleteCategoryAdmin');
			}
		);
		Route::group(
			['prefix' => 'user',],
			function () {
				Route::get('/', [UserAdminController::class, 'index'])->name('indexUserAdmin');
				Route::get('/add', [UserAdminController::class, 'create'])->name('createUserAdmin');
				Route::post('/add', [UserAdminController::class, 'store'])->name('storeUserAdmin');
				Route::get('/{login}/edit', [UserAdminController::class, 'edit'])->name('editUserAdmin');
				Route::post('/{login}/update', [UserAdminController::class, 'update'])->name('updateUserAdmin');
				Route::get('/{login}/delete', [UserAdminController::class, 'destroy'])->name('deleteUserAdmin');
			}
		);
		Route::group(
			['prefix' => 'group',],
			function () {
				Route::get('/', [GroupAdminController::class, 'index'])->name('indexGroupAdmin');
				Route::get('/add', [GroupAdminController::class, 'create'])->name('createGroupAdmin');
				Route::post('/add', [GroupAdminController::class, 'store'])->name('storeGroupAdmin');
				Route::get('/{group}/edit', [GroupAdminController::class, 'edit'])->name('editGroupAdmin');
				Route::post('/{group}/update', [GroupAdminController::class, 'update'])->name('updateGroupAdmin');
				Route::get('/{group}/delete', [GroupAdminController::class, 'destroy'])->name('deleteGroupAdmin');
			}
		);
		Route::group(
			['prefix' => 'people',],
			function () {
				Route::get('/', [PeopleAdminController::class, 'index'])->name('indexPeopleAdmin');
				Route::get('/{people}/edit', [PeopleAdminController::class, 'edit'])->name('editPeopleAdmin');
			}
		);
		Route::group(
			['prefix' => 'channel',],
			function () {
				Route::get('/', [ChannelAdminController::class, 'index'])->name('indexChannelAdmin');
				Route::get('/add', [ChannelAdminController::class, 'create'])->name('createChannelAdmin');
				Route::post('/add', [ChannelAdminController::class, 'store'])->name('storeChannelAdmin');
				Route::get('/{channel}/edit', [ChannelAdminController::class, 'edit'])->name('editChannelAdmin');
				Route::post('/{channel}/update', [ChannelAdminController::class, 'update'])->name('updateChannelAdmin');
				Route::get('/{channel}/delete', [ChannelAdminController::class, 'destroy'])->name('deleteChannelAdmin');
			}
		);
		Route::group(
			['prefix' => 'character',],
			function () {
				Route::get('/', [ChannelAdminController::class, 'index'])->name('indexCharacterAdmin');
				Route::get('/add', [ChannelAdminController::class, 'create'])->name('createCharacterAdmin');
				Route::post('/add', [ChannelAdminController::class, 'store'])->name('storeCharacterAdmin');
				Route::get('/{character}/edit', [ChannelAdminController::class, 'edit'])->name('editCharacterAdmin');
				Route::post('/{character}/update', [ChannelAdminController::class, 'update'])->name('updateCharacterAdmin');
				Route::get('/{character}/delete', [ChannelAdminController::class, 'destroy'])->name('deleteCharacterAdmin');
			}
		);
		Route::group(
			['prefix' => 'copyright_holder',],
			function () {
				Route::get('/', [CopyrightHolderAdminController::class, 'index'])->name('indexCopyrightHolderAdmin');
				Route::get('/add', [CopyrightHolderAdminController::class, 'create'])->name('createCopyrightHolderAdmin');
				Route::post('/add', [CopyrightHolderAdminController::class, 'store'])->name('storeCopyrightHolderAdmin');
				Route::get('/{copyright_holder}/edit', [CopyrightHolderAdminController::class, 'edit'])->name('editCopyrightHolderAdmin');
				Route::post('/{copyright_holder}/update', [CopyrightHolderAdminController::class, 'update'])->name('updateCopyrightHolderAdmin');
				Route::get('/{copyright_holder}/delete', [CopyrightHolderAdminController::class, 'destroy'])->name('deleteCopyrightHolderAdmin');
			}
		);
		Route::group(
			['prefix' => 'country',],
			function () {
				Route::get('/', [CountryAdminController::class, 'index'])->name('indexCountryAdmin');
				Route::get('/add', [CountryAdminController::class, 'create'])->name('createCountryAdmin');
				Route::post('/add', [CountryAdminController::class, 'store'])->name('storeCountryAdmin');
				Route::get('/{country}/edit', [CountryAdminController::class, 'edit'])->name('editCountryAdmin');
				Route::post('/{country}/update', [CountryAdminController::class, 'update'])->name('updateCountryAdmin');
				Route::get('/{country}/delete', [CountryAdminController::class, 'destroy'])->name('deleteCountryAdmin');
			}
		);
		Route::group(
			['prefix' => 'faq',],
			function () {
				Route::get('/', [FaqAdminController::class, 'index'])->name('indexFaqAdmin');
				Route::get('/add', [FaqAdminController::class, 'create'])->name('createFaqAdmin');
				Route::post('/add', [FaqAdminController::class, 'store'])->name('storeFaqAdmin');
				Route::get('/{faq}/edit', [FaqAdminController::class, 'edit'])->name('editFaqAdmin');
				Route::post('/{faq}/update', [FaqAdminController::class, 'update'])->name('updateFaqAdmin');
				Route::get('/{faq}/delete', [FaqAdminController::class, 'destroy'])->name('deleteFaqAdmin');
			}
		);
		Route::group(
			['prefix' => 'job',],
			function () {
				Route::get('/', [JobPeopleAdminController::class, 'index'])->name('indexJobAdmin');
				Route::get('/add', [JobPeopleAdminController::class, 'create'])->name('createJobAdmin');
				Route::post('/add', [JobPeopleAdminController::class, 'store'])->name('storeJobAdmin');
				Route::get('/{job}/edit', [JobPeopleAdminController::class, 'edit'])->name('editJobAdmin');
				Route::post('/{job}/update', [JobPeopleAdminController::class, 'update'])->name('updateJobAdmin');
				Route::get('/{job}/delete', [JobPeopleAdminController::class, 'destroy'])->name('deleteJobAdmin');
			}
		);
		Route::group(
			['prefix' => 'kind',],
			function () {
				Route::get('/', [KindAdminController::class, 'index'])->name('indexKindAdmin');
				Route::get('/add', [KindAdminController::class, 'create'])->name('createKindAdmin');
				Route::post('/add', [KindAdminController::class, 'store'])->name('storeKindAdmin');
				Route::get('/{kind}/edit', [KindAdminController::class, 'edit'])->name('editKindAdmin');
				Route::post('/{kind}/update', [KindAdminController::class, 'update'])->name('updateKindAdmin');
				Route::get('/{kind}/delete', [KindAdminController::class, 'destroy'])->name('deleteKindAdmin');
			}
		);
		Route::group(
			['prefix' => 'mpaa',],
			function () {
				Route::get('/', [MPAAAdminController::class, 'index'])->name('indexMpaaAdmin');
				Route::get('/add', [MPAAAdminController::class, 'create'])->name('createMpaaAdmin');
				Route::post('/add', [MPAAAdminController::class, 'store'])->name('storeMpaaAdmin');
				Route::get('/{mpaa}/edit', [MPAAAdminController::class, 'edit'])->name('editMpaaAdmin');
				Route::post('/{mpaa}/update', [MPAAAdminController::class, 'update'])->name('updateMpaaAdmin');
				Route::get('/{mpaa}/delete', [MPAAAdminController::class, 'destroy'])->name('deleteMpaaAdmin');
			}
		);
		Route::group(
			['prefix' => 'news',],
			function () {
				Route::get('/', [NewsAdminController::class, 'index'])->name('indexNewsAdmin');
				Route::get('/add', [NewsAdminController::class, 'create'])->name('createNewsAdmin');
				Route::post('/add', [NewsAdminController::class, 'store'])->name('storeNewsAdmin');
				Route::get('/{news}/edit', [NewsAdminController::class, 'edit'])->name('editNewsAdmin');
				Route::post('/{news}/update', [NewsAdminController::class, 'update'])->name('updateNewsAdmin');
				Route::get('/{news}/delete', [NewsAdminController::class, 'destroy'])->name('deleteNewsAdmin');
			}
		);
		Route::group(
			['prefix' => 'quality',],
			function () {
				Route::get('/', [QualityAdminController::class, 'index'])->name('indexQualityAdmin');
				Route::get('/add', [QualityAdminController::class, 'create'])->name('createQualityAdmin');
				Route::post('/add', [QualityAdminController::class, 'store'])->name('storeQualityAdmin');
				Route::get('/{quality}/edit', [QualityAdminController::class, 'edit'])->name('editQualityAdmin');
				Route::post('/{quality}/update', [QualityAdminController::class, 'update'])->name('updateQualityAdmin');
				Route::get('/{quality}/delete', [QualityAdminController::class, 'destroy'])->name('deleteQualityAdmin');
			}
		);
		Route::group(
			['prefix' => 'studio',],
			function () {
				Route::get('/', [StudioAdminController::class, 'index'])->name('indexStudioAdmin');
				Route::get('/add', [StudioAdminController::class, 'create'])->name('createStudioAdmin');
				Route::post('/add', [StudioAdminController::class, 'store'])->name('storeStudioAdmin');
				Route::get('/{studio}/edit', [StudioAdminController::class, 'edit'])->name('editStudioAdmin');
				Route::post('/{studio}/update', [StudioAdminController::class, 'update'])->name('updateStudioAdmin');
				Route::get('/{studio}/delete', [StudioAdminController::class, 'destroy'])->name('deleteStudioAdmin');
			}
		);
		Route::group(
			['prefix' => 'table_order',],
			function () {
				Route::get('/', [TableOrderAdminController::class, 'index'])->name('indexTableOrderAdmin');
				Route::get('/add', [TableOrderAdminController::class, 'create'])->name('createTableOrderAdmin');
				Route::post('/add', [TableOrderAdminController::class, 'store'])->name('storeTableOrderAdmin');
				Route::get('/{table_order}/edit', [TableOrderAdminController::class, 'edit'])->name('editTableOrderAdmin');
				Route::post('/{table_order}/update', [TableOrderAdminController::class, 'update'])->name('updateTableOrderAdmin');
				Route::get('/{table_order}/delete', [TableOrderAdminController::class, 'destroy'])->name('deleteTableOrderAdmin');
			}
		);
		Route::group(
			['prefix' => 'translate',],
			function () {
				Route::get('/', [TranslateAdminController::class, 'index'])->name('indexTranslateAdmin');
				Route::get('/add', [TranslateAdminController::class, 'create'])->name('createTranslateAdmin');
				Route::post('/add', [TranslateAdminController::class, 'store'])->name('storeTranslateAdmin');
				Route::get('/{translate}/edit', [TranslateAdminController::class, 'edit'])->name('editTranslateAdmin');
				Route::post('/{translate}/update', [TranslateAdminController::class, 'update'])->name('updateTranslateAdmin');
				Route::get('/{translate}/delete', [TranslateAdminController::class, 'destroy'])->name('deleteTranslateAdmin');
			}
		);
		Route::group(
			['prefix' => 'year_aired',],
			function () {
				Route::get('/', [YearAiredAdminController::class, 'index'])->name('indexYearAiredAdmin');
				Route::get('/add', [YearAiredAdminController::class, 'create'])->name('createYearAiredAdmin');
				Route::post('/add', [YearAiredAdminController::class, 'store'])->name('storeYearAiredAdmin');
				Route::get('/{year_aired}/edit', [YearAiredAdminController::class, 'edit'])->name('editYearAiredAdmin');
				Route::post('/{year_aired}/update', [YearAiredAdminController::class, 'update'])->name('updateYearAiredAdmin');
				Route::get('/{year_aired}/delete', [YearAiredAdminController::class, 'destroy'])->name('deleteYearAiredAdmin');
			}
		);
		Route::group(
			['prefix' => 'static_page',],
			function () {
				Route::get('/', [StaticPageAdminController::class, 'index'])->name('indexStaticPageAdmin');
				Route::get('/add', [StaticPageAdminController::class, 'create'])->name('createStaticPageAdmin');
				Route::post('/add', [StaticPageAdminController::class, 'store'])->name('storeStaticPageAdmin');
				Route::get('/{static_page}/edit', [StaticPageAdminController::class, 'edit'])->name('editStaticPageAdmin');
				Route::post('/{static_page}/update', [StaticPageAdminController::class, 'update'])->name('updateStaticPageAdmin');
				Route::get('/{static_page}/delete', [StaticPageAdminController::class, 'destroy'])->name('deleteStaticPageAdmin');
			}
		);
		Route::group(
			['prefix' => 'geo',],
			function () {
				Route::get('/', [StaticPageAdminController::class, 'index'])->name('indexGeoAdmin');
				Route::get('/add', [StaticPageAdminController::class, 'create'])->name('createGeoAdmin');
				Route::post('/add', [StaticPageAdminController::class, 'store'])->name('storeGeoAdmin');
				Route::get('/{geo}/edit', [StaticPageAdminController::class, 'edit'])->name('editGeoAdmin');
				Route::post('/{geo}/update', [StaticPageAdminController::class, 'update'])->name('updateGeoAdmin');
				Route::get('/{geo}/delete', [StaticPageAdminController::class, 'destroy'])->name('deleteGeoAdmin');
			}
		);
	}
);