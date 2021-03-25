<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface YearAiredRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface YearAiredRepositoryInterfaces
{
	/**
	 * @param  string  $yearUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $yearUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getYearAired(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setYearAired(string $name, Request $request): mixed;
}