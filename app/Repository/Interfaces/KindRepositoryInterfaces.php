<?php


namespace App\Repository\Interfaces;


/**
 * Interface KindRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface KindRepositoryInterfaces
{
	/**
	 * @param string $kindUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $kindUrl);

	/**
	 * @return mixed
	 */
	public function getKind();
}