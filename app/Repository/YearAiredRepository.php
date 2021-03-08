<?php


namespace App\Repository;


use App\Models\YearAired;
use App\Repository\Interfaces\YearAiredRepositoryInterfaces;

/**
 * Class YearAiredRepository
 *
 * @package App\Repository
 */
class YearAiredRepository implements YearAiredRepositoryInterfaces
{

	/**
	 * @param $year
	 *
	 * @return mixed
	 */
	public function getAnime($year)
	{
		return YearAired::where('name', $year)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getYearAired()
	{
		return YearAired::get();
	}
}