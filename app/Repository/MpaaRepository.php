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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getMpaa(string $url = null): mixed
	{
		if ($url) {
			return MPAARating::where('url', $url);
		}
		return MPAARating::orderBy('id', 'ASC');
	}

	/**
	 * Добавление/обновление MPAA рейтинга
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url      Урл MPAA рейтинга
	 *
	 * @return mixed
	 */
	public function setMpaa(Request $request, string $url = null): mixed
	{
		// TODO: Implement setMpaa() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delMpaa(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delMpaa() method.
	}
}