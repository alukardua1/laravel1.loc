<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface TranslateRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface TranslateRepositoryInterfaces
{
	/**
	 * Получает озвучивание по названию
	 *
	 * @param  string  $translateUrl  Урл озвучмвания
	 *
	 * @return mixed
	 */
	public function getAnime(string $translateUrl): mixed;

	/**
	 * Получает все озвучивания
	 *
	 * @return mixed
	 */
	public function getTranslate(): mixed;

	/**
	 * Добавление/обновление озвучивания
	 *
	 * @param  string   $translateUrl  Урл озвучмвания
	 * @param  Request  $request       Запрос
	 *
	 * @return mixed
	 */
	public function setTranslate(string $translateUrl, Request $request): mixed;
}