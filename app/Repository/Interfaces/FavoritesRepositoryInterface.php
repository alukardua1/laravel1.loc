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
interface FavoritesRepositoryInterface
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

    public function getFavorite($user_id);
}
