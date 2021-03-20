<?php


namespace App\Repository;


use App\Models\GeoBlock;
use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;

class GeoBlockRepository implements GeoBlockRepositoryInterfaces
{

	public function getAnime(string $geoBlock)
	{
		return GeoBlock::where('code', $geoBlock);
	}

	public function getGeoBlock()
	{
		return GeoBlock::get();
	}
}