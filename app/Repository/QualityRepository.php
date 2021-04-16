<?php


namespace App\Repository;


use App\Models\Quality;
use App\Repository\Interfaces\QualityRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class QualityRepository
 *
 * @package App\Repository
 */
class QualityRepository implements QualityRepositoryInterfaces
{

	/**
	 * Получает качество видео по названию
	 *
	 * @param  string  $qualityUrl  Урл качество видео
	 *
	 * @return mixed
	 */
	public function getAnime(string $qualityUrl): mixed
	{
		return Quality::where('url', $qualityUrl)
			->first();
	}

	/**
	 * Получает все качество видео
	 *
	 * @return mixed
	 */
	public function getQuality(): mixed
	{
		return Quality::get();
	}

	/**
	 * Добавление/обновление качества видео
	 *
	 * @param  string   $qualityUrl  Урл качество видео
	 * @param  Request  $request     запрос
	 *
	 * @return mixed
	 */
	public function setQuality(string $qualityUrl, Request $request): mixed
	{
		// TODO: Implement setQuality() method.
	}
}