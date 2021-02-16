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
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getCategories()
	{
		return Category::where('posted_at', '=', 1)
			->latest()
			->get();
	}

	/**
	 * @param $category
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getCategory($category)
	{
		return Category::latest()
			->where('url', $category)
			->first();
	}
}