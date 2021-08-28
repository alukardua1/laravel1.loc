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
	 * Получает страну по названию
	 *
	 * @param  string  $countryUrl Урл страны
	 *
	 * @return mixed
	 */
	public function getAnime(string $countryUrl): mixed;

	/**
	 * Получает все страны
	 *
	 * @return mixed
	 */
	public function getCountry(): mixed;

	/**
	 * Добавление/обновление страны
	 *
	 * @param  string   $countryUrl Урл страны
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setCountry(string $countryUrl, Request $request): mixed;

	public function deleteCountry(string $countryUrl);
}