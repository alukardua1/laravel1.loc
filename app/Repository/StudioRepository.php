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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getStudio(string $url = null): mixed
	{
		if ($url) {
			return Studio::where('url', $url);
		}
		return Studio::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление студии
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url      Урл студии
	 *
	 * @return mixed
	 */
	public function setStudio(Request $request, string $url = null): mixed
	{
		// TODO: Implement setStudio() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delStudio(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delStudio() method.
	}
}