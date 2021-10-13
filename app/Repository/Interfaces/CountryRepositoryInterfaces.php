<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface CountryRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface CountryRepositoryInterfaces
{
	/**
	 * Получает все страны
	 *
	 * @param  string|null  $countryUrl
	 *
	 * @return mixed
	 */
	public function getCountry(string $countryUrl = null): mixed;

	/**
	 * Добавление/обновление страны
	 *
	 * @param  string   $countryUrl  Урл страны
	 * @param  Request  $request     Запрос
	 *
	 * @return mixed
	 */
	public function setCountry(string $countryUrl, Request $request): mixed;

	/**
	 * @param  string  $countryUrl
	 *
	 * @return mixed
	 */
	public function deleteCountry(string $countryUrl): mixed;
}