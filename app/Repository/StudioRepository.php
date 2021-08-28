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
	 * Получает студию по названию
	 *
	 * @param  string  $studioUrl  Урл студии
	 *
	 * @return mixed
	 */
	public function getAnime(string $studioUrl): mixed
	{
		return Studio::where('url', $studioUrl)
			->first();
	}

	/**
	 * Получает все студии
	 *
	 * @return mixed
	 */
	public function getStudio(): mixed
	{
		return Studio::get();
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
}