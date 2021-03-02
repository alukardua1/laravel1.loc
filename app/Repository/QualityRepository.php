<?php


namespace App\Repository;


use App\Models\Quality;
use App\Repository\Interfaces\QualityRepositoryInterfaces;

class QualityRepository implements QualityRepositoryInterfaces
{

	public function getAnime($kind)
	{
		return Quality::latest()
			->where('url', $kind)
			->first();
	}

	public function getQuality()
	{
		return Quality::latest()
			->get();
	}
}