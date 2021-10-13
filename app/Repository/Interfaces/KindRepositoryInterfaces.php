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
	 * @param  string|null  $kindUrl
	 *
	 * @return mixed
	 */
	public function getKind(string $kindUrl = null): mixed;

	/**
	 * Добавление/обновление типа
	 *
	 * @param  string   $kindUrl  Урл типа
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setKind(string $kindUrl, Request $request): mixed;

	/**
	 * @param  string  $kindUrl
	 *
	 * @return mixed
	 */
	public function delKind(string $kindUrl): mixed;
}