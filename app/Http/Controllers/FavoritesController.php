<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\FavoritesRepositoryInterface;
use Cache;
use Config;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
	/**
	 * @var FavoritesRepositoryInterface $favoriteRepository
	 */
	private $favoriteRepository;

	/**
	 * FavoriteController constructor.
	 *
	 * @param  \App\Repository\Interfaces\FavoritesRepositoryInterface  $favoriteRepositoryInterfaces
	 */
	public function __construct(FavoritesRepositoryInterface $favoriteRepositoryInterfaces)
	{
		$this->keyCache = 'favorite_';
		$this->favoriteRepository = $favoriteRepositoryInterfaces;
		$this->paginate = Config::get('secondConfig.paginate');
	}

	public function index($user, Request $request)
	{
		$page = 'page_' . $request->get('page', 1);
		if (Cache::has($this->keyCache . $page) and (Config::get('secondConfig.cache_time') > 0)) {
			$allAnime = Cache::get($this->keyCache . $page);
		} else {
			$allAnime = self::setCache(
				$this->keyCache . $page,
				$this->favoriteRepository->getFavorite($user)->favorites()->paginate($this->paginate)
			);
		}

		return view($this->frontend . 'anime.short', compact('allAnime'));
		//dd($this->favoriteRepository->getFavorite($user)->favorites()->paginate($this->paginate));
	}

	/**
	 * Добавить в закладки
	 *
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function add($id): string
	{
		$this->favoriteRepository->favorite($id);

		return url()->previous();
	}

	/**
	 * Убрать из закладок
	 *
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function delete($id): string
	{
		$this->favoriteRepository->unFavorite($id);

		return url()->previous();
	}
}
