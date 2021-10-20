<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface QualityRepositoryInterfaces
{
	/**
	 * Получает все качество видео
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getQuality(string $url = null): mixed;

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
	public function delQuality(string $url, bool $fullDel = false): mixed;
}