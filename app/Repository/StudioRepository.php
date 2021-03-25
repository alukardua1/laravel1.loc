<?php


namespace App\Repository;


use App\Models\Studio;
use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function getAnime(string $studioUrl): mixed
	{
		return Studio::where('url', $studioUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getStudio(): mixed
	{
		return Studio::get();
	}

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setStudio(string $name, Request $request): mixed
	{
		// TODO: Implement setStudio() method.
	}
}