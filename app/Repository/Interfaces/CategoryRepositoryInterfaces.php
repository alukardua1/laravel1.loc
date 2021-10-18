<?php


namespace App\Repository\Interfaces;

use App\Http\Requests\CategoryRequest;

/**
 * Interface CategoryRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface CategoryRepositoryInterfaces
{

	/**
	 * Получает все категории
	 *
	 * @param  string|null  $categoryUrl
	 * @param  bool|false   $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl = null, bool $isAdmin = false): mixed;

	/**
	 * Добавление/обновление категории
	 *
	 * @param  string|null                         $categoryUrl  Урл категории
	 * @param  \App\Http\Requests\CategoryRequest  $request      Запрос
	 *
	 * @return mixed
	 */
	public function setCategory(CategoryRequest $request, string $categoryUrl = null): mixed;

	/**
	 * @param  string  $categoryUrl
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delCategory(string $categoryUrl, bool $fullDel = false): mixed;
}