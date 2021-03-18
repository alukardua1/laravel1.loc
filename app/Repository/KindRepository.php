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
	 * @param  string  $kindUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $kindUrl)
	{
		return Kind::where('url', $kindUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getKind()
	{
		return Kind::get();
	}
}