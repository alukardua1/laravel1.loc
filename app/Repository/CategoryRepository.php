<?php


namespace App\Repository;


use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

/**
 * Class CategoryRepository
 *
 * @package App\Repository
 */
class CategoryRepository implements CategoryRepositoryInterfaces
{

	/**
	 * @return mixed
	 */
	public function getCategories()
	{
		return Category::where('posted_at', '=', 1);
	}

	/**
	 * @param  string  $categoryUrl
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl)
	{
		return Category::where('url', $categoryUrl);
	}
}