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
	 * @param string $qualityUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $qualityUrl);

	/**
	 * @return mixed
	 */
	public function getQuality();
}