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
	 * Получает год по названию
	 *
	 * @param  string  $yearUrl  Урл года
	 *
	 * @return mixed
	 */
	public function getAnime(string $yearUrl): mixed
	{
		return YearAired::where('name', $yearUrl)
			->first();
	}

	/**
	 * Получает все года
	 *
	 * @return mixed
	 */
	public function getYearAired(): mixed
	{
		return YearAired::get();
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
}