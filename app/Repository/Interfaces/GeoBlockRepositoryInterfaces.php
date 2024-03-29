<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface GeoBlockRepositoryInterfaces
{
	/**
	 * Получает ГеоБлок
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getGeoBlock(string $url = null, bool $isAdmin = false): mixed;

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
	public function deleteGeoBlock(string $url, bool $fullDel = false): mixed;
}