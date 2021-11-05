<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository;


use App\Models\User;
use App\Repository\Interfaces\FavoriteRepositoryInterfaces;
use Auth;

class FavoriteRepository implements FavoriteRepositoryInterfaces
{
	/**
	 * Добавляет в избранное
	 *
	 * @param  int  $id  ID добавляемой записи
	 *
	 * @return mixed
	 */
	public function favorite(int $id): mixed
	{
		Auth::user()
			->favorites()
			->attach($id);
	}

	/**
	 * Удаляет из избранного
	 *
	 * @param  int  $id  ID добавляемой записи
	 *
	 * @return mixed
	 */
	public function unFavorite(int $id): mixed
	{
		Auth::user()
			->favorites()
			->detach($id);
	}

	/**
	 * Получает все избранное пользователя
	 *
	 * @param  string  $login  Логин пользователя
	 *
	 * @return mixed
	 */
	public function getFavorite(string $login): mixed
	{
		return User::where('login', $login)
			->first();
	}
}
