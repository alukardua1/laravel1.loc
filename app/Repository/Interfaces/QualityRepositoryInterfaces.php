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
	 * Получает качество видео по названию
	 *
	 * @param  string  $qualityUrl  Урл качество видео
	 *
	 * @return mixed
	 */
	public function getAnime(string $qualityUrl): mixed;

	/**
	 * Получает все качество видео
	 *
	 * @return mixed
	 */
	public function getQuality(): mixed;

	/**
	 * Добавление/обновление качества видео
	 *
	 * @param  string   $qualityUrl  Урл качество видео
	 * @param  Request  $request     запрос
	 *
	 * @return mixed
	 */
	public function setQuality(string $qualityUrl, Request $request): mixed;
}