<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

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
	public function deleteMpaa(string $url, bool $fullDel = false): mixed;
}