<?php


namespace App\Repository;


use App\Models\Kind;
use App\Repository\Interfaces\KindRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class KindRepository
 *
 * @package App\Repository
 */
class KindRepository implements KindRepositoryInterfaces
{

	/**
	 * Получает тип по названию
	 *
	 * @param  string  $kindUrl Урл типа
	 *
	 * @return mixed
	 */
	public function getAnime(string $kindUrl): mixed
	{
		return Kind::where('url', $kindUrl)
			->first();
	}

	/**
	 * Получает все типы
	 *
	 * @return mixed
	 */
	public function getKind(): mixed
	{
		return Kind::get();
	}

	/**
	 * Добавление/обновление типа
	 *
	 * @param  string   $kindUrl Урл типа
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setKind(string $kindUrl, Request $request): mixed
	{
		// TODO: Implement setKind() method.
	}
}