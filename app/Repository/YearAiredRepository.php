<?php


namespace App\Repository;


use App\Models\YearAired;
use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class YearAiredRepository
 *
 * @package App\Repository
 */
class YearAiredRepository implements YearAiredRepositoryInterfaces
{
	/**
	 * Получает все года
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getYearAired(string $url = null): mixed
	{
		if ($url) {
			return YearAired::where('year', $url);
		}
		return YearAired::orderBy('year', 'ASC');
	}

	/**
	 * Добавление/обновление года
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url      Урл года
	 *
	 * @return mixed
	 */
	public function setYearAired(Request $request, string $url = null): mixed
	{
		// TODO: Implement setYearAired() method.
	}

	/**
	 * Удаляет
	 *
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delYearAired(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delYearAired() method.
	}
}