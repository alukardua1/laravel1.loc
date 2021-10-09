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
	 * @param  int|null  $id  ID записи
	 *
	 * @param  bool      $isAdmin
	 *
	 * @return mixed
	 */
	public function getAnime(int $id = null, bool $isAdmin = false): mixed;

	/**
	 * Получает количество аниме
	 *
	 * @return mixed
	 */
	public function countAnime(): mixed;

	/**
	 * Формирует для главной страницы
	 *
	 * @param  int  $limit  количество выводимых записей
	 *
	 * @return mixed
	 * @todo доработать
	 *
	 */
	public function getFirstPageAnime(int $limit): mixed;

	/**
	 * Вывод варимативного
	 *
	 * @param  string  $columns  столбец
	 * @param  string  $custom   строка поиска
	 *
	 * @return mixed
	 */
	public function getCustomAnime(string $columns, string $custom): mixed;

	/**
	 * Вывод анонса
	 *
	 * @param  int  $limit  количество выводимых записей
	 *
	 * @return mixed
	 */
	public function getAnons(int $limit): mixed;

	/**
	 * Вывод популярного
	 *
	 * @param  int  $limit  количество выводимых записей
	 *
	 * @return mixed
	 */
	public function getPopular(int $limit): mixed;

	/**
	 * Поиск
	 *
	 * @param  Request  $request  Запрос
	 * @param  int      $limit    количество выводимых записей
	 *
	 * @return mixed
	 */
	public function getSearchAnime(Request $request, int $limit = 5): mixed;

	/**
	 * Добавление/обновление комментариев
	 *
	 * @param  int      $id       ID записи
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setComment(int $id, Request $request): mixed;

	/**
	 * Удаление комментариев
	 *
	 * @param  int   $id       ID записи
	 * @param  bool  $fullDel  удалить послностью или нет
	 *
	 * @throws \Exception
	 * @return mixed
	 */
	public function delComments(int $id, bool $fullDel): mixed;

	/**
	 * Добавление/обновление аниме
	 *
	 * @param  Request   $request  Запрос
	 * @param  int|null  $id       ID записи
	 *
	 * @return mixed
	 */
	public function setAnime(Request $request, int $id = null): mixed;

	/**
	 * Удаляет текущую запись
	 *
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function destroyAnime(int $id): mixed;
}