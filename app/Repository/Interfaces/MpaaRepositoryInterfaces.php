<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface MpaaRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface MpaaRepositoryInterfaces
{
	/**
	 * Получает MPAA рейтинги
	 *
	 * @param  string|null  $mpaaUrl
	 *
	 * @return mixed
	 */
	public function getMpaa(string $mpaaUrl = null): mixed;

	/**
	 * Добавление/обновление MPAA рейтинга
	 *
	 * @param  string   $mpaaUrl  Урл MPAA рейтинга
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setMpaa(string $mpaaUrl, Request $request): mixed;

	/**
	 * @param  string  $mpaaUrl
	 *
	 * @return mixed
	 */
	public function delMpaa(string $mpaaUrl): mixed;
}