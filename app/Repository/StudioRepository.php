<?php


namespace App\Repository;


use App\Models\Studio;
use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class StudioRepository
 *
 * @package App\Repository
 */
class StudioRepository implements StudioRepositoryInterfaces
{
	/**
	 * Получает все студии
	 *
	 * @param  string|null  $studioUrl
	 *
	 * @return mixed
	 */
	public function getStudio(string $studioUrl = null): mixed
	{
		if ($studioUrl) {
			return Studio::where('url', $studioUrl);
		}
		return Studio::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление студии
	 *
	 * @param  string   $studioUrl  Урл студии
	 * @param  Request  $request    Запрос
	 *
	 * @return mixed
	 */
	public function setStudio(string $studioUrl, Request $request): mixed
	{
		// TODO: Implement setStudio() method.
	}

	/**
	 * @param  string  $studioUrl
	 *
	 * @return mixed
	 */
	public function delStudio(string $studioUrl): mixed
	{
		// TODO: Implement delStudio() method.
	}
}