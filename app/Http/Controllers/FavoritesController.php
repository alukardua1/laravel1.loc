<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\FavoriteRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FavoritesController extends Controller
{
	private FavoriteRepositoryInterfaces $favoriteRepository;

	/**
	 * @param  \App\Repository\Interfaces\FavoriteRepositoryInterfaces  $favoriteRepositoryInterfaces
	 */
	public function __construct(FavoriteRepositoryInterfaces $favoriteRepositoryInterfaces)
	{
		parent::__construct();
		$this->favoriteRepository = $favoriteRepositoryInterfaces;
	}

	/**
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(string $login): View|Factory|Application
	{
		$allAnime = $this->favoriteRepository->getFavorite($login)->favorites()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('allAnime'));
	}

	/**
	 * Добавить в закладки
	 *
	 * @param  int  $id
	 *
	 * @return string
	 */
	public function add(int $id): string
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
	public function delete(int $id): string
	{
		$this->favoriteRepository->unFavorite($id);

		return url()->previous();
	}
}
