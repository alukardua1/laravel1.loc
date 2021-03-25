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
	 * @param  string  $geoBlock
	 *
	 * @return mixed
	 */
	public function getAnime(string $geoBlock): mixed;

	/**
	 * @return mixed
	 */
	public function getGeoBlock(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setGeoBlock(string $name, Request $request): mixed;
}