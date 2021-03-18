<?php


namespace App\Repository;


use App\Models\Country;
use App\Repository\Interfaces\CountryRepositoryInterfaces;

/**
 * Class CountryRepository
 *
 * @package App\Repository
 */
class CountryRepository implements CountryRepositoryInterfaces
{
	/**
	 * @param  string  $countryUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $countryUrl)
	{
		return Country::where('url', $countryUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getCountry()
	{
		return Country::get();
	}
}