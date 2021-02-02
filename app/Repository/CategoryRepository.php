<?php


namespace App\Repository;


use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryRepository implements CategoryRepositoryInterfaces
{

	public function getCategories()
	{
		return Category::with(['getAnime']);
	}

	public function getCategory($category)
	{
		return Category::with(['getAnime'])->where('url', $category);
	}
}