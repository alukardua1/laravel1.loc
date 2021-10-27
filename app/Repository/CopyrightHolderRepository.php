<?php


namespace App\Repository;


use App\Models\CopyrightHolder;
use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class CopyrightHolderRepository
 *
 * @package App\Repository
 */
class CopyrightHolderRepository implements CopyrightHolderRepositoryInterfaces
{
	/**
	 * Получает всех правообладателей
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(string $url = null): mixed
	{
		if ($url) {
			return CopyrightHolder::where('title', $url);
		}
		return CopyrightHolder::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление правообладателя
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(Request $request, string $url = null): mixed
	{
		// TODO: Implement setCopyrightHolder() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCopyrightHolder(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement deleteCopyrightHolder() method.
	}
}