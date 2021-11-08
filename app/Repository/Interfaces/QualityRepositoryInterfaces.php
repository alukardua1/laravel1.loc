<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface QualityRepositoryInterfaces
{
	/**
	 * Получает все качество видео
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getQuality(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * Добавление/обновление качества видео
	 *
	 * @param  \Illuminate\Http\Request  $request  запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setQuality(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteQuality(string $url, bool $fullDel = false): mixed;
}