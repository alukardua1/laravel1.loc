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
	 * @param  string  $yearUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $yearUrl)
	{
		return YearAired::where('name', $yearUrl)
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