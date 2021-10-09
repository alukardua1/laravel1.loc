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
	 * Получает все года
	 *
	 * @param  string|null  $yearUrl
	 *
	 * @return mixed
	 */
	public function getYearAired(string $yearUrl = null): mixed;

	/**
	 * Добавление/обновление года
	 *
	 * @param  string   $yearUrl  Урл года
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setYearAired(string $yearUrl, Request $request): mixed;

	public function delYearAired(string $yearUrl): mixed;
}