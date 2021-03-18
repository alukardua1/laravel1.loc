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
	 * @param  string  $studioUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $studioUrl)
	{
		return Studio::where('url', $studioUrl)
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