<?php


namespace App\Repository;


use App\Models\Quality;
use App\Repository\Interfaces\QualityRepositoryInterfaces;

/**
 * Class QualityRepository
 *
 * @package App\Repository
 */
class QualityRepository implements QualityRepositoryInterfaces
{

	/**
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return Quality::latest()
			->where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getQuality()
	{
		return Quality::latest()
			->get();
	}
}