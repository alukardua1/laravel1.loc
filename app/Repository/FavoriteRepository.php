<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository;


use App\Models\User;
use App\Repository\Interfaces\FavoritesRepositoryInterfaces;
use Auth;

/**
 * Class FavoriteRepository
 *
 * @package App\Repositories
 */
class FavoriteRepository implements FavoritesRepositoryInterfaces
{
	/**
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function favorite(int $id)
	{
		Auth::user()
			->favorites()
			->attach($id);
	}

	/**
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function unFavorite(int $id)
	{
		Auth::user()
			->favorites()
			->detach($id);
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function getFavorite(string $login)
	{
		return User::where('login', $login)
			->first();
	}
}
