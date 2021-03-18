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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind);

	/**
	 * @return mixed
	 */
	public function getCountry();
}