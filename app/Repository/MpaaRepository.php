<?php


namespace App\Repository;


use App\Models\MPAARating;
use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class MpaaRepository
 *
 * @package App\Repository
 */
class MpaaRepository implements MpaaRepositoryInterfaces
{
	/**
	 * Получает MPAA рейтинг по названию
	 *
	 * @param  string  $mpaaUrl  Урл MPAA рейтинга
	 *
	 * @return mixed
	 */
	public function getAnime(string $mpaaUrl): mixed
	{
		return MPAARating::where('url', $mpaaUrl)
			->first();
	}

	/**
	 * Получает MPAA рейтинги
	 *
	 * @return mixed
	 */
	public function getMpaa(): mixed
	{
		return MPAARating::get();
	}

	/**
	 * Добавление/обновление MPAA рейтинга
	 *
	 * @param  string   $mpaaUrl  Урл MPAA рейтинга
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setMpaa(string $mpaaUrl, Request $request): mixed
	{
		// TODO: Implement setMpaa() method.
	}
}