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
	 * Получает все страны
	 *
	 * @return mixed
	 */
	public function getCountry(string $countryUrl = null): mixed
	{
		if ($countryUrl) {
			return Country::where('url', $countryUrl)
				->first();
		}
		return Country::orderBy('name', 'ASC');
	}

	/**
	 * Добавление/обновление страны
	 *
	 * @param  string   $countryUrl  Урл страны
	 * @param  Request  $request     Запрос
	 *
	 * @return mixed
	 */
	public function setCountry(string $countryUrl, Request $request): mixed
	{
		// TODO: Implement setCountry() method.
	}

	/**
	 * @param  string  $countryUrl
	 */
	public function deleteCountry(string $countryUrl)
	{
		// TODO: Implement deleteCountry() method.
	}
}