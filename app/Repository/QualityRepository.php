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
	 * Получает все качество видео
	 *
	 * @param  string|null  $qualityUrl
	 *
	 * @return mixed
	 */
	public function getQuality(string $qualityUrl = null): mixed
	{
		if ($qualityUrl) {
			return Quality::where('url', $qualityUrl);
		}
		return Quality::orderBy('title', 'ASC');
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

	/**
	 * @param  string  $qualityUrl
	 *
	 * @return mixed
	 */
	public function delQuality(string $qualityUrl): mixed
	{
		// TODO: Implement delQuality() method.
	}
}