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
	 * @param  string|null  $translateUrl
	 *
	 * @return mixed
	 */
	public function getTranslate(string $translateUrl = null): mixed
	{
		if ($translateUrl) {
			return Translate::where('url', $translateUrl);
		}
		return Translate::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление озвучивания
	 *
	 * @param  string   $translateUrl  Урл озвучмвания
	 * @param  Request  $request       Запрос
	 *
	 * @return mixed
	 */
	public function setTranslate(string $translateUrl, Request $request): mixed
	{
		// TODO: Implement setTranslate() method.
	}

	public function delTranslate(string $translateUrl): mixed
	{
		// TODO: Implement delTranslate() method.
	}
}