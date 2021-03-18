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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind);

	/**
	 * @return mixed
	 */
	public function getStudio();
}