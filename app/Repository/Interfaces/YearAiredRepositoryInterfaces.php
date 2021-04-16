<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface YearAiredRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface YearAiredRepositoryInterfaces
{
	/**
	 * Получает год по названию
	 *
	 * @param  string  $yearUrl  Урл года
	 *
	 * @return mixed
	 */
	public function getAnime(string $yearUrl): mixed;

	/**
	 * Получает все года
	 *
	 * @return mixed
	 */
	public function getYearAired(): mixed;

	/**
	 * Добавление/обновление года
	 *
	 * @param  string   $yearUrl  Урл года
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setYearAired(string $yearUrl, Request $request): mixed;
}