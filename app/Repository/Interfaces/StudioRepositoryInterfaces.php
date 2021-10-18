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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getStudio(string $url = null): mixed;

	/**
	 * Добавление/обновление студии
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setStudio(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delStudio(string $url, bool $fullDel = false): mixed;
}