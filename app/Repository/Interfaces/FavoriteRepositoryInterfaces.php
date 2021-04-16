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
     * Добавляет в избранное
     *
     * @param int $id ID добавляемой записи
     *
     * @return mixed
     */
    public function favorite(int $id): mixed;

    /**
     * Удаляет из избранного
     *
     * @param int $id ID добавляемой записи
     *
     * @return mixed
     */
    public function unFavorite(int $id): mixed;

	/**
	 * Получает все избранное пользователя
	 *
	 * @param string $login Логин пользователя
	 *
	 * @return mixed
	 */
	public function getFavorite(string $login): mixed;
}
