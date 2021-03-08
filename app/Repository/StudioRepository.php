<?php


namespace App\Repository;


use App\Models\Studio;
use App\Repository\Interfaces\StudioRepositoryInterfaces;

/**
 * Class StudioRepository
 *
 * @package App\Repository
 */
class StudioRepository implements StudioRepositoryInterfaces
{

	/**
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return Studio::where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getStudio()
	{
		return Studio::get();
	}
}