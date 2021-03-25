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
	 * @return mixed
	 */
	public function getCategories(): mixed
	{
		return Category::where('posted_at', '=', 1);
	}

	/**
	 * @param  string  $categoryUrl
	 *
	 * @return mixed
	 */
	public function getCategory(string $categoryUrl): mixed
	{
		return Category::where('url', $categoryUrl);
	}

	/**
	 * @param  string                    $url
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return mixed
	 */
	public function setCategory(string $url, Request $request): mixed
	{
		// TODO: Implement setCategory() method.
	}
}