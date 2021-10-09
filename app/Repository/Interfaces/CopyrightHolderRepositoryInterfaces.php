<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface CopyrightHolderRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface CopyrightHolderRepositoryInterfaces
{
	/**
	 * Получает всех правообладателей
	 *
	 * @param  string|null  $copyrightHolder
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(string $copyrightHolder = null): mixed;

	/**
	 * Добавление/обновление правообладателя
	 *
	 * @param  string   $copyrightHolder  Урл правообладателя
	 * @param  Request  $request          Запрос
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(string $copyrightHolder, Request $request): mixed;

	/**
	 * @param  string  $copyrightHolder
	 *
	 * @return mixed
	 */
	public function deleteCopyrightHolder(string $copyrightHolder);
}