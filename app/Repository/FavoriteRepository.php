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
	 * @param $id
	 *
	 * @return mixed|void
	 */
	public function favorite($id)
	{
		Auth::user()
			->favorites()
			->attach($id);
	}

	/**
	 * @param $id
	 *
	 * @return mixed|void
	 */
	public function unFavorite($id)
	{
		Auth::user()
			->favorites()
			->detach($id);
	}

	/**
	 * @param $user_id
	 *
	 * @return mixed
	 */
	public function getFavorite($user_id)
	{
		return User::latest()
			->where('login', $user_id)
			->first();
	}
}
