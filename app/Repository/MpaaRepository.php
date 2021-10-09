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
	 * Получает MPAA рейтинги
	 *
	 * @param  string|null  $mpaaUrl
	 *
	 * @return mixed
	 */
	public function getMpaa(string $mpaaUrl = null): mixed
	{
		if ($mpaaUrl) {
			return MPAARating::where('url', $mpaaUrl);
		}
		return MPAARating::orderBy('id', 'ASC');
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

	/**
	 * @param  string  $mpaaUrl
	 *
	 * @return mixed
	 */
	public function delMpaa(string $mpaaUrl): mixed
	{
		// TODO: Implement delMpaa() method.
	}
}