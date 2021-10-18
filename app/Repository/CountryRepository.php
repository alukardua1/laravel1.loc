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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCountry(string $url = null): mixed
	{
		if ($url) {
			return Country::where('url', $url)
				->first();
		}
		return Country::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление страны
	 *
	 * @param  string|null  $url
	 * @param  Request      $request  Запрос
	 *
	 * @return mixed
	 */
	public function setCountry(Request $request, string $url = null): mixed
	{
		// TODO: Implement setCountry() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCountry(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement deleteCountry() method.
	}
}