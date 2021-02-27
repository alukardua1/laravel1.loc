<?php


namespace App\Repository;


use App\Models\Kind;
use App\Repository\Interfaces\KindRepositoryInterfaces;

class KindRepository implements KindRepositoryInterfaces
{

	public function getAnime($kind)
	{
		return Kind::latest()
			->where('url', $kind)
			->first();
	}

	public function getKind()
	{
		return Kind::latest()
			->get();
	}
}