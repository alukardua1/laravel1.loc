<?php


namespace App\Repository\Interfaces;


/**
 * Interface QualityRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface QualityRepositoryInterfaces
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
	public function getQuality();
}