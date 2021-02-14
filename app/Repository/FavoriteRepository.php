<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository;


use App\Repository\Interfaces\FavoritesRepositoryInterface;
use Auth;

/**
 * Class FavoriteRepository
 *
 * @package App\Repositories
 */
class FavoriteRepository implements FavoritesRepositoryInterface
{
	/**
	 * @param $id
	 *
	 * @return mixed|void
	 */
	public function favorite($id)
	{
		return Auth::user()->favorites()->attach($id);
	}

	/**
	 * @param $id
	 *
	 * @return mixed|void
	 */
	public function unFavorite($id)
	{
		return Auth::user()->favorites()->detach($id);
	}
}