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
	 * Получает тип по названию
	 *
	 * @param  string  $kindUrl Урл типа
	 *
	 * @return mixed
	 */
	public function getAnime(string $kindUrl): mixed;

	/**
	 * Получает все типы
	 *
	 * @return mixed
	 */
	public function getKind(): mixed;

	/**
	 * Добавление/обновление типа
	 *
	 * @param  string   $kindUrl Урл типа
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setKind(string $kindUrl, Request $request): mixed;
}