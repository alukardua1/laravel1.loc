<?php


namespace App\Repository;


use App\Models\MPAARating;
use App\Repository\Interfaces\MpaaRepositoryInterface;

class MpaaRepository implements MpaaRepositoryInterface
{
	/**
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return MPAARating::latest()
			->where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getMpaa()
	{
		return MPAARating::latest()
			->get();
	}
}