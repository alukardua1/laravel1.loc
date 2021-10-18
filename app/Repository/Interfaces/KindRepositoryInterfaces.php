<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface KindRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface KindRepositoryInterfaces
{
	/**
	 * Получает все типы
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getKind(string $url = null): mixed;

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