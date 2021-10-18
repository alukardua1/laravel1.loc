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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getGeoBlock(string $url = null): mixed
	{
		if ($url) {
			return GeoBlock::where('code', $url);
		}
		return GeoBlock::orderBy('code', 'ASC');
	}

	/**
	 * Добавление/обновление ГеоБлока
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setGeoBlock(Request $request, string $url = null): mixed
	{
		// TODO: Implement setGeoBlock() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delGeoBlock(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delGeoBlock() method.
	}
}