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
	 * @param  string  $countryUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $countryUrl): mixed
	{
		return Country::where('url', $countryUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getCountry(): mixed
	{
		return Country::get();
	}

	/**
	 * @param  string   $url
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setCountry(string $url, Request $request): mixed
	{
		// TODO: Implement setCountry() method.
	}
}