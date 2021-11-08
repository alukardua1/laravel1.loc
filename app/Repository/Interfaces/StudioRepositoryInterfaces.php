<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface StudioRepositoryInterfaces
{
	/**
	 * Получает все студии
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getStudio(string $url = null, bool $isAdmin = false): mixed;

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
	public function deleteStudio(string $url, bool $fullDel = false): mixed;
}