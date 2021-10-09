<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface QualityRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface QualityRepositoryInterfaces
{
	/**
	 * Получает все качество видео
	 *
	 * @param  string|null  $qualityUrl
	 *
	 * @return mixed
	 */
	public function getQuality(string $qualityUrl = null): mixed;

	/**
	 * Добавление/обновление качества видео
	 *
	 * @param  string   $qualityUrl  Урл качество видео
	 * @param  Request  $request     запрос
	 *
	 * @return mixed
	 */
	public function setQuality(string $qualityUrl, Request $request): mixed;

	/**
	 * @param  string  $qualityUrl
	 *
	 * @return mixed
	 */
	public function delQuality(string $qualityUrl): mixed;
}