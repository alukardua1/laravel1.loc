<?php


namespace App\Repository;


use App\Models\Kind;
use App\Repository\Interfaces\KindRepositoryInterfaces;

/**
 * Class KindRepository
 *
 * @package App\Repository
 */
class KindRepository implements KindRepositoryInterfaces
{

	/**
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return Kind::latest()
			->where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getKind()
	{
		return Kind::latest()
			->get();
	}
}