<?php


namespace App\Repository\Interfaces;

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
	 * @return mixed
	 */
	public function getCategories(): mixed;

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
	 * @param  string   $categoryUrl Урл категории
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setCategory(string $categoryUrl, Request $request): mixed;
}