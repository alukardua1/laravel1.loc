<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface MpaaRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface MpaaRepositoryInterfaces
{
	/**
	 * Получает MPAA рейтинги
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getMpaa(string $url = null): mixed;

	/**
	 * Добавление/обновление MPAA рейтинга
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setMpaa(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delMpaa(string $url, bool $fullDel = false): mixed;
}