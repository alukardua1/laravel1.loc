<?php


namespace App\Repository;


use App\Models\Country;
use App\Repository\Interfaces\CountryRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class CountryRepository
 *
 * @package App\Repository
 */
class CountryRepository implements CountryRepositoryInterfaces
{
	/**
	 * Получает страну по названию
	 *
	 * @param  string  $countryUrl Урл страны
	 *
	 * @return mixed
	 */
	public function getAnime(string $countryUrl): mixed
	{
		return Country::where('url', $countryUrl)
			->first();
	}

	/**
	 * Получает все страны
	 *
	 * @return mixed
	 */
	public function getCountry(): mixed
	{
		return Country::get();
	}

	/**
	 * Добавление/обновление страны
	 *
	 * @param  string   $countryUrl Урл страны
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setCountry(string $countryUrl, Request $request): mixed
	{
		// TODO: Implement setCountry() method.
	}
}