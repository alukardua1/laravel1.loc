<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface TranslateRepositoryInterfaces
{
	/**
	 * Получает все озвучивания
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getTranslate(string $url = null): mixed;

	/**
	 * Добавление/обновление озвучивания
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setTranslate(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delTranslate(string $url, bool $fullDel = false): mixed;
}