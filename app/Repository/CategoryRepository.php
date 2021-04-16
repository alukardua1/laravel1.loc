<?php


namespace App\Repository;


use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class CategoryRepository
 *
 * @package App\Repository
 */
class CategoryRepository implements CategoryRepositoryInterfaces
{

	/**
	 * Получает все категории
	 *
	 * @return mixed
	 */
	public function getCategories(): mixed
	{
		return Category::where('posted_at', '=', 1);
	}

	/**
	 * Получает категорию по названию
	 *
	 * @param  string  $categoryUrl Урл категории
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl): mixed
	{
		return Category::where('url', $categoryUrl);
	}

	/**
	 * Добавление/обновление категории
	 *
	 * @param  string   $categoryUrl Урл категории
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setCategory(string $categoryUrl, Request $request): mixed
	{
		// TODO: Implement setCategory() method.
	}
}