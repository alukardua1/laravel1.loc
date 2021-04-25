<?php


namespace App\Repository\Interfaces;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

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
	 * @param  bool|false  $isAdmin
	 *
	 * @return mixed
	 */
	public function getCategories(bool $isAdmin = false): mixed;

	/**
	 * Получает категорию по названию
	 *
	 * @param  string  $categoryUrl Урл категории
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl): mixed;

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
	 *
	 * @return mixed
	 */
	public function delCategory(string $categoryUrl);
}