<?php


namespace App\Repository\Interfaces;


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
	public function getAnime(string $studioUrl);

	/**
	 * @return mixed
	 */
	public function getStudio();
}