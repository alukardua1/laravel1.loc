<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface AnimeRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface AnimeRepositoryInterfaces
{
	/**
	 * Получает аниме по ID
	 *
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function getAnime(int $id);

	/**
	 * Получает все аниме с проверкой для админпанели или для сайта
	 *
	 * @param  bool  $isAdmin
	 *
	 * @return mixed
	 */
	public function getAllAnime(bool $isAdmin = false);

	/**
	 * Формирует для главной страницы (в разработке)
	 *
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime(int $limit);

	/**
	 * Вывод варимативного
	 *
	 * @param  string  $columns
	 * @param  string  $custom
	 *
	 * @return mixed
	 */
	public function getCustomAnime(string $columns, string $custom);

	/**
	 * Вывод анонса
	 *
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getAnons(int $limit);

	/**
	 * Вывод популярного
	 *
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getPopular(int $limit);

	/**
	 * Поиск
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int                       $limit
	 *
	 * @return mixed
	 */
	public function getSearchAnime(Request $request, int $limit = 5);

	/**
	 * Добавление/обновление комментариев
	 *
	 * @param  int                       $id
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return mixed
	 */
	public function setComment(int $id, Request $request);

	/**
	 * Удаление комментариев
	 *
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @return mixed
	 */
	public function delComments(int $id, bool $fullDel);

	/**
	 * Добавление/обновление аниме
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int                       $id
	 *
	 * @return mixed
	 */
	public function setAnime(Request $request, int $id);
}