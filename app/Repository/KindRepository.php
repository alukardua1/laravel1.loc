<?php


namespace App\Repository;


use App\Models\Kind;
use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function getAnime(string $kindUrl): mixed
	{
		return Kind::where('url', $kindUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getKind(): mixed
	{
		return Kind::get();
	}

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setKind(string $name, Request $request): mixed
	{
		// TODO: Implement setKind() method.
	}
}