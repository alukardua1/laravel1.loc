<?php


namespace App\Repository;


use App\Models\Translate;
use App\Repository\Interfaces\TranslateRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class TranslateRepository
 *
 * @package App\Repository
 */
class TranslateRepository implements TranslateRepositoryInterfaces
{
	/**
	 * Получает все озвучивания
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getTranslate(string $url = null): mixed
	{
		if ($url) {
			return Translate::where('url', $url);
		}
		return Translate::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление озвучивания
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url      Урл озвучмвания
	 *
	 * @return mixed
	 */
	public function setTranslate(Request $request, string $url = null): mixed
	{
		// TODO: Implement setTranslate() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteTranslate(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delTranslate() method.
	}
}