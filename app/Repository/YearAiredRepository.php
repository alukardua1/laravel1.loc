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
	 * @param  string|null  $yearUrl
	 *
	 * @return mixed
	 */
	public function getYearAired(string $yearUrl = null): mixed
	{
		if ($yearUrl) {
			return YearAired::where('year', $yearUrl);
		}
		return YearAired::orderBy('year', 'ASC');
	}

	/**
	 * Добавление/обновление года
	 *
	 * @param  string   $yearUrl  Урл года
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setYearAired(string $yearUrl, Request $request): mixed
	{
		// TODO: Implement setYearAired() method.
	}

	public function delYearAired(string $yearUrl): mixed
	{
		// TODO: Implement delYearAired() method.
	}
}