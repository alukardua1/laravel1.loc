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
	 * Получает ГеоБлок по коду
	 *
	 * @param  string  $geoBlock Код ГеоБлока
	 *
	 * @return mixed
	 */
	public function getAnime(string $geoBlock): mixed;

	/**
	 * Получает ГеоБлок
	 *
	 * @return mixed
	 */
	public function getGeoBlock(): mixed;

	/**
	 * Добавление/обновление ГеоБлока
	 *
	 * @param  string   $geoBlock
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setGeoBlock(string $geoBlock, Request $request): mixed;
}