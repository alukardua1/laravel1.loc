<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface GeoBlockRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface GeoBlockRepositoryInterfaces
{
	/**
	 * Получает ГеоБлок
	 *
	 * @param  string|null  $geoBlock
	 *
	 * @return mixed
	 */
	public function getGeoBlock(string $geoBlock = null): mixed;

	/**
	 * Добавление/обновление ГеоБлока
	 *
	 * @param  string   $geoBlock
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setGeoBlock(string $geoBlock, Request $request): mixed;

	/**
	 * @param  string  $geoBlock
	 *
	 * @return mixed
	 */
	public function delGeoBlock(string $geoBlock): mixed;
}