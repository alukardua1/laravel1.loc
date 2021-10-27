<?php


namespace App\Repository\Interfaces;

use App\Http\Requests\CategoryRequest;

interface CategoryRepositoryInterfaces
{

	/**
	 * Получает все категории
	 *
	 * @param  string|null  $url
	 * @param  bool|false   $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategory(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * Добавление/обновление категории
	 *
	 * @param  \App\Http\Requests\CategoryRequest  $request  Запрос
	 * @param  string|null                         $url
	 *
	 * @return mixed
	 */
	public function setCategory(CategoryRequest $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCategory(string $url, bool $fullDel = false): mixed;
}