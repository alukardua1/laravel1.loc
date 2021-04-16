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
	 * Получает озвучивание по названию
	 *
	 * @param  string  $translateUrl  Урл озвучмвания
	 *
	 * @return mixed
	 */
	public function getAnime($translateUrl): mixed
	{
		return Translate::where('url', $translateUrl)
			->first();
	}

	/**
	 * Получает все озвучивания
	 *
	 * @return mixed
	 */
	public function getTranslate(): mixed
	{
		return Translate::get();
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
}