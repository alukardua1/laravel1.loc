<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\FavoritesRepositoryInterface;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
	/**
	 * @var FavoritesRepositoryInterface $favoriteRepository
	 */
	private static $favoriteRepository;

	/**
	 * FavoriteController constructor.
	 *
	 * @param  \App\Repository\Interfaces\FavoritesRepositoryInterface  $favoriteRepositoryInterfaces
	 */
	public function __construct(FavoritesRepositoryInterface $favoriteRepositoryInterfaces)
	{
		self::$favoriteRepository = $favoriteRepositoryInterfaces;
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
		self::$favoriteRepository->favorite($id);

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
		self::$favoriteRepository->unFavorite($id);

		return url()->previous();
	}
}
