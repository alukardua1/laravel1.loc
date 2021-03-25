<?php


namespace App\Repository;


use App\Models\Quality;
use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function getAnime(string $qualityUrl): mixed
	{
		return Quality::where('url', $qualityUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getQuality(): mixed
	{
		return Quality::get();
	}

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setQuality(string $name, Request $request): mixed
	{
		// TODO: Implement setQuality() method.
	}
}