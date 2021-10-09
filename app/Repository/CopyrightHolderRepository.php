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
	 * @param  string|null  $copyrightHolder
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(string $copyrightHolder = null): mixed
	{
		if ($copyrightHolder) {
			return CopyrightHolder::where('copyright_holder', $copyrightHolder);
		}
		return CopyrightHolder::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление правообладателя
	 *
	 * @param  string   $copyrightHolder  Урл правообладателя
	 * @param  Request  $request          Запрос
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(string $copyrightHolder, Request $request): mixed
	{
		// TODO: Implement setCopyrightHolder() method.
	}

	/**
	 * @param  string  $copyrightHolder
	 *
	 * @return mixed|void
	 */
	public function deleteCopyrightHolder(string $copyrightHolder)
	{
		// TODO: Implement deleteCopyrightHolder() method.
	}
}