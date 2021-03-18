<?php


namespace App\Repository;


use App\Models\MPAARating;
use App\Repository\Interfaces\MpaaRepositoryInterfaces;

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
	public function getAnime(string $mpaaUrl)
	{
		return MPAARating::where('url', $mpaaUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getMpaa()
	{
		return MPAARating::get();
	}
}