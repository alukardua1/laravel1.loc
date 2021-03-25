<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface StudioRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface StudioRepositoryInterfaces
{
	/**
	 * @param  string  $studioUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $studioUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getStudio(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setStudio(string $name, Request $request): mixed;
}