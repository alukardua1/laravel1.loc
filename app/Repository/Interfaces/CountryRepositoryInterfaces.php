<?php


namespace App\Repository\Interfaces;


/**
 * Interface CountryRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface CountryRepositoryInterfaces
{
	/**
	 * @param string $countryUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $countryUrl);

	/**
	 * @return mixed
	 */
	public function getCountry();
}