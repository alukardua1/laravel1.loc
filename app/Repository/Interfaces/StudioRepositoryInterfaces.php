<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface StudioRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface StudioRepositoryInterfaces
{
	/**
	 * Получает студию по названию
	 *
	 * @param  string  $studioUrl Урл студии
	 *
	 * @return mixed
	 */
	public function getAnime(string $studioUrl): mixed;

	/**
	 * Получает все студии
	 *
	 * @return mixed
	 */
	public function getStudio(): mixed;

	/**
	 * Добавление/обновление студии
	 *
	 * @param  string   $studioUrl Урл студии
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setStudio(string $studioUrl, Request $request): mixed;
}