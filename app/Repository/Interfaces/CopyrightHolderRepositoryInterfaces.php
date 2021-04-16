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
	 * Получает правобладателя по названию
	 *
	 * @param  string  $copyrightHolder  Урл правообладателя
	 *
	 * @return mixed
	 */
	public function getAnime(string $copyrightHolder): mixed;

	/**
	 * Получает всех правообладателей
	 *
	 * @return mixed
	 */
	public function getCopyrightHolder(): mixed;

	/**
	 * Добавление/обновление правообладателя
	 *
	 * @param  string   $copyrightHolder Урл правообладателя
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setCopyrightHolder(string $copyrightHolder, Request $request): mixed;
}