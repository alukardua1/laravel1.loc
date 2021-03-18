<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\FavoriteRepositoryInterfaces;

class FavoritesController extends Controller
{
	private FavoriteRepositoryInterfaces $favoriteRepository;

	/**
	 * FavoriteController constructor.
	 *
	 * @param  FavoriteRepositoryInterfaces  $favoriteRepositoryInterfaces
	 */
	public function __construct(FavoriteRepositoryInterfaces $favoriteRepositoryInterfaces)
	{
		parent::__construct();
		$this->favoriteRepository = $favoriteRepositoryInterfaces;
	}

	/**
	 * @param string $login
	 *
	 * @return mixed
	 */
	public function index(string $login)
	{
		$allAnime = $this->favoriteRepository->getFavorite($login)->favorites()->paginate($this->paginate);
		return view($this->frontend . 'anime.short', compact('allAnime'));
	}

	/**
	 * Добавить в закладки
	 *
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function add(int $id)
	{
		$this->favoriteRepository->favorite($id);

		return url()->previous();
	}

	/**
	 * Убрать из закладок
	 *
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function delete(int $id)
	{
		$this->favoriteRepository->unFavorite($id);

		return url()->previous();
	}
}
