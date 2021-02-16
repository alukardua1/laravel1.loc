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
		$this->favoriteRepository = $favoriteRepositoryInterfaces;
		$this->paginate = Config::get('secondConfig.paginate');
	}

	public function index($user)
	{
		$allAnime = $this->favoriteRepository->getFavorite($user)->favorites()->paginate($this->paginate);
		return view($this->frontend . 'anime.short', compact('allAnime'));
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
