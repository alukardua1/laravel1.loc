<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

interface CopyrightHolderRepositoryInterfaces
{
	/**
	 * Получает всех правообладателей
	 *
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(string $url = null, bool $isAdmin = false): mixed;

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