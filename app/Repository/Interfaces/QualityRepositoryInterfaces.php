<?php


namespace App\Repository\Interfaces;


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