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
interface FavoritesRepositoryInterfaces
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function favorite($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function unFavorite($id);

	/**
	 * @param $user_id
	 *
	 * @return mixed
	 */
	public function getFavorite($user_id);
}