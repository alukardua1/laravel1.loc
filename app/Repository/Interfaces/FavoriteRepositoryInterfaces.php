<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository\Interfaces;


/**
 * Interface FavoritesRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface FavoriteRepositoryInterfaces
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function favorite(int $id);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function unFavorite(int $id);

	/**
	 * @param string $login
	 *
	 * @return mixed
	 */
	public function getFavorite(string $login);
}
