<?php


namespace App\Repository;


use App\Models\GeoBlock;
use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class GeoBlockRepository
 *
 * @package App\Repository
 */
class GeoBlockRepository implements GeoBlockRepositoryInterfaces
{

	/**
	 * @param  string  $geoBlock
	 *
	 * @return mixed
	 */
	public function getAnime(string $geoBlock): mixed
	{
		return GeoBlock::where('code', $geoBlock);
	}

	/**
	 * @return mixed
	 */
	public function getGeoBlock(): mixed
	{
		return GeoBlock::get();
	}

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setGeoBlock(string $name, Request $request): mixed
	{
		// TODO: Implement setGeoBlock() method.
	}
}