<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface CountryRepositoryInterfaces
{
	/**
	 * Получает все страны
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCountry(string $url = null): mixed;

	/**
	 * Добавление/обновление страны
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setCountry(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCountry(string $url, bool $fullDel = false): mixed;
}