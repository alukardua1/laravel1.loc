<?php


namespace App\Repository;


use App\Models\MPAARating;
use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class MpaaRepository
 *
 * @package App\Repository
 */
class MpaaRepository implements MpaaRepositoryInterfaces
{
	/**
	 * @param  string  $mpaaUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $mpaaUrl): mixed
	{
		return MPAARating::where('url', $mpaaUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getMpaa(): mixed
	{
		return MPAARating::get();
	}

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setMpaa(string $name, Request $request): mixed
	{
		// TODO: Implement setMpaa() method.
	}
}