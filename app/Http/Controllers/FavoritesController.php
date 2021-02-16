<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\FavoritesRepositoryInterface;

class FavoritesController extends Controller
{
	private $favoriteRepository;

	/**
	 * FavoriteController constructor.
	 *
	 * @param  \App\Repository\Interfaces\FavoritesRepositoryInterface  $favoriteRepositoryInterfaces
	 */
	public function __construct(FavoritesRepositoryInterface $favoriteRepositoryInterfaces)
	{
		parent::__construct();
		$this->favoriteRepository = $favoriteRepositoryInterfaces;
	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
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
