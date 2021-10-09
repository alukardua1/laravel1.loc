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
	 * Получает все озвучивания
	 *
	 * @param  string|null  $translateUrl
	 *
	 * @return mixed
	 */
	public function getTranslate(string $translateUrl = null): mixed;

	/**
	 * Добавление/обновление озвучивания
	 *
	 * @param  string   $translateUrl  Урл озвучмвания
	 * @param  Request  $request       Запрос
	 *
	 * @return mixed
	 */
	public function setTranslate(string $translateUrl, Request $request): mixed;

	/**
	 * @param  string  $translateUrl
	 *
	 * @return mixed
	 */
	public function delTranslate(string $translateUrl): mixed;
}