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
	 * Получает все студии
	 *
	 * @param  string|null  $studioUrl
	 *
	 * @return mixed
	 */
	public function getStudio(string $studioUrl = null): mixed;

	/**
	 * Добавление/обновление студии
	 *
	 * @param  string   $studioUrl  Урл студии
	 * @param  Request  $request    Запрос
	 *
	 * @return mixed
	 */
	public function setStudio(string $studioUrl, Request $request): mixed;

	/**
	 * @param  string  $studioUrl
	 *
	 * @return mixed
	 */
	public function delStudio(string $studioUrl): mixed;
}