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
	 * Получает ГеоБлок по коду
	 *
	 * @param  string  $geoBlock  Код ГеоБлока
	 *
	 * @return mixed
	 */
	public function getAnime(string $geoBlock): mixed
	{
		return GeoBlock::where('code', $geoBlock);
	}

	/**
	 * Получает ГеоБлок
	 *
	 * @return mixed
	 */
	public function getGeoBlock(): mixed
	{
		return GeoBlock::get();
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
}