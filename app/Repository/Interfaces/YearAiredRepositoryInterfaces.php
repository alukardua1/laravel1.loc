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
	 * @param $year
	 *
	 * @return mixed
	 */
	public function getAnime($year);

	/**
	 * @return mixed
	 */
	public function getYearAired();
}