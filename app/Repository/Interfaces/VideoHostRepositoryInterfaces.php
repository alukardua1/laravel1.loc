<?php


namespace App\Repository\Interfaces;

interface VideoHostRepositoryInterfaces
{
	/**
	 * Выводит все записи
	 *
	 * @param  array|null  $other
	 *
	 * @return mixed
	 */
	public function list(array $other = null): mixed;

	/**
	 * Поиск
	 *
	 * @param  array  $search
	 *
	 * @return mixed
	 */
	public function search(array $search): mixed;
}