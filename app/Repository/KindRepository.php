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
	 * Получает все типы
	 *
	 * @param  string|null  $kindUrl
	 *
	 * @return mixed
	 */
	public function getKind(string $kindUrl = null): mixed
	{
		if ($kindUrl) {
			return Kind::where('url', $kindUrl);
		}
		return Kind::orderBy('name', 'ASC');
	}

	/**
	 * Добавление/обновление типа
	 *
	 * @param  string   $kindUrl  Урл типа
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setKind(string $kindUrl, Request $request): mixed
	{
		// TODO: Implement setKind() method.
	}

	/**
	 * @param  string  $kindUrl
	 *
	 * @return mixed
	 */
	public function delKind(string $kindUrl): mixed
	{
		// TODO: Implement delKind() method.
	}
}