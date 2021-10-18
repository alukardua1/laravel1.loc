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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getKind(string $url = null): mixed
	{
		if ($url) {
			return Kind::where('url', $url);
		}
		return Kind::orderBy('name', 'ASC');
	}

	/**
	 * Добавление/обновление типа
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url      Урл типа
	 *
	 * @return mixed
	 */
	public function setKind(Request $request, string $url = null): mixed
	{
		// TODO: Implement setKind() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delKind(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delKind() method.
	}
}