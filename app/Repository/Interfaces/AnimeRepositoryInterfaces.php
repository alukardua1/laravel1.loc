<?php


namespace App\Repository\Interfaces;


/**
 * Interface AnimeRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface AnimeRepositoryInterfaces
{
	/**
	 * Получает аниме по ID
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getAnime($id);

	/**
	 * Получает все аниме с проверкой для админпанели или для сайта
	 * @param  bool  $isAdmin
	 *
	 * @return mixed
	 */
	public function getAllAnime($isAdmin = false);

	/**
	 * Формирует для главной страницы (в разработке)
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime($count);

	/**
	 * Вывод варимативного
	 * @param $columns
	 * @param $custom
	 *
	 * @return mixed
	 */
	public function getCustomAnime($columns, $custom);

	/**
	 * Вывод анонса
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getAnons($count);

	/**
	 * Вывод популярного
	 * @param $count
	 *
	 * @return mixed
	 */
	public function getPopular($count);

	/**
	 * Поиск
	 * @param       $request
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getSearchAnime($request, $limit = 5);

	/**
	 * Добавление/обновление комментариев
	 * @param $id
	 * @param $request
	 *
	 * @return mixed
	 */
	public function setComment($id, $request);

	/**
	 * Удаление комментариев
	 * @param $id
	 * @param $fullDel
	 *
	 * @return mixed
	 */
	public function delComments($id, $fullDel);

	/**
	 * Добавление/обновление аниме
	 * @param $request
	 * @param $id
	 *
	 * @return mixed
	 */
	public function setAnime($request, $id);
}