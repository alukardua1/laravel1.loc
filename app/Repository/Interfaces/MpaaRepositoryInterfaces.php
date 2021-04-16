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
	 * Получает MPAA рейтинг по названию
	 *
	 * @param  string  $mpaaUrl Урл MPAA рейтинга
	 *
	 * @return mixed
	 */
	public function getAnime(string $mpaaUrl): mixed;

	/**
	 * Получает MPAA рейтинги
	 *
	 * @return mixed
	 */
	public function getMpaa(): mixed;

	/**
	 * Добавление/обновление MPAA рейтинга
	 *
	 * @param  string   $mpaaUrl Урл MPAA рейтинга
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setMpaa(string $mpaaUrl, Request $request): mixed;
}