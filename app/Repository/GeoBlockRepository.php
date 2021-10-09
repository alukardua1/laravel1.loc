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
	 * Получает ГеоБлок
	 *
	 * @param  string|null  $geoBlock
	 *
	 * @return mixed
	 */
	public function getGeoBlock(string $geoBlock = null): mixed
	{
		if ($geoBlock) {
			return GeoBlock::where('code', $geoBlock);
		}
		return GeoBlock::orderBy('code', 'ASC');
	}

	/**
	 * Добавление/обновление ГеоБлока
	 *
	 * @param  string   $geoBlock
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setGeoBlock(string $geoBlock, Request $request): mixed
	{
		// TODO: Implement setGeoBlock() method.
	}

	public function delGeoBlock(string $geoBlock): mixed
	{
		// TODO: Implement delGeoBlock() method.
	}
}