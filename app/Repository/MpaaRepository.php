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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return MPAARating::where('url', $kind)
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