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
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(string $url = null): mixed;

	/**
	 * Добавление/обновление правообладателя
	 *
	 * @param  \Illuminate\Http\Request  $request  Запрос
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCopyrightHolder(string $url, bool $fullDel = false): mixed;
}