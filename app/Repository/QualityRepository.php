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
	 * @param $qualityUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $qualityUrl)
	{
		return Quality::where('url', $qualityUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getQuality()
	{
		return Quality::get();
	}
}