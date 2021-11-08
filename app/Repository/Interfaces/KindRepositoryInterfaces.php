<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface KindRepositoryInterfaces
{
	/**
	 * Получает все типы
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getKind(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * Добавление/обновление типа
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setKind(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delKind(string $url, bool $fullDel = false): mixed;
}