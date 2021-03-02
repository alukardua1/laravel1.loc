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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return Country::latest()
			->where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getCountry()
	{
		return Country::latest()
			->get();
	}
}