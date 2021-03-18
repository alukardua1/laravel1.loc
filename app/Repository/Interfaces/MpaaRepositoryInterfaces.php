<?php


namespace App\Repository\Interfaces;


/**
 * Interface MpaaRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface MpaaRepositoryInterfaces
{
	/**
	 * @param string $mpaaUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $mpaaUrl);

	/**
	 * @return mixed
	 */
	public function getMpaa();
}