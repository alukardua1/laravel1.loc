<?php


namespace App\Repository\Interfaces;


/**
 * Interface YearAiredRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface YearAiredRepositoryInterfaces
{
	/**
	 * @param string $yearUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $yearUrl);

	/**
	 * @return mixed
	 */
	public function getYearAired();
}