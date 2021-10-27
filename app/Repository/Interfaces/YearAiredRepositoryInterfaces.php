<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface YearAiredRepositoryInterfaces
{
	/**
	 * Получает все года
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getYearAired(string $url = null): mixed;

	/**
	 * Добавление/обновление года
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setYearAired(Request $request, string $url = null): mixed;

	/**
	 * Удаление
	 *
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteYearAired(string $url, bool $fullDel = false): mixed;
}