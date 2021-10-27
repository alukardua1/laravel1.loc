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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getQuality(string $url = null): mixed
	{
		if ($url) {
			return Quality::where('url', $url);
		}
		return Quality::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление качества видео
	 *
	 * @param  \Illuminate\Http\Request  $request  запрос
	 * @param  string|null               $url      Урл качество видео
	 *
	 * @return mixed
	 */
	public function setQuality(Request $request, string $url = null): mixed
	{
		// TODO: Implement setQuality() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteQuality(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delQuality() method.
	}
}