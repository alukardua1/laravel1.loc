<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface GeoBlockRepositoryInterfaces
{
	/**
	 * Получает ГеоБлок
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getGeoBlock(string $url = null): mixed;

	/**
	 * Добавление/обновление ГеоБлока
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setGeoBlock(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delGeoBlock(string $url, bool $fullDel = false): mixed;
}