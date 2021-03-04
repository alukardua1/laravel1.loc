<?php

use App\Http\Controllers\Api\AnimeApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get(
	'/user',
	function (Request $request) {
		return $request->user();
	}
);*/
Route::group(
	['prefix' => 'anime'],
	function () {
		Route::get('/', [AnimeApiController::class, 'index']);
		Route::get('/{id}', [AnimeApiController::class, 'show']);
	}
);
Route::group(
	['prefix' => 'user'],
	function () {
		Route::get('/{name}', [UserApiController::class, 'show']);
		Route::get('/{name}/{custom}', [UserApiController::class, 'show']);
	}
);