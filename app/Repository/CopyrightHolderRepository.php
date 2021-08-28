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
	 * Получает правобладателя по названию
	 *
	 * @param  string  $copyrightHolder  Урл правообладателя
	 *
	 * @return mixed
	 */
	public function getAnime(string $copyrightHolder): mixed
	{
		return CopyrightHolder::where('copyright_holder', $copyrightHolder);
	}

	/**
	 * Получает всех правообладателей
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(): mixed
	{
		return CopyrightHolder::get();
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

	public function deleteCopyrightHolder(string $copyrightHolder)
	{
		// TODO: Implement deleteCopyrightHolder() method.
	}
}