<?php


namespace App\Repository;


use App\Models\YearAired;
use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function getAnime(string $yearUrl): mixed
	{
		return YearAired::where('name', $yearUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getYearAired(): mixed
	{
		return YearAired::get();
	}

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setYearAired(string $name, Request $request): mixed
	{
		// TODO: Implement setYearAired() method.
	}
}