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
	 * @param  string  $countryUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $countryUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getCountry(): mixed;

	/**
	 * @param  string   $url
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setCountry(string $url, Request $request): mixed;
}