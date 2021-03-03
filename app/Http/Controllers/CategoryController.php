<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
	private   $categories;

	/**
	 * CategoryController constructor.
	 *
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		parent::__construct();
		$this->categories = $categoryRepositoryInterfaces;
	}

	public function index($category)
	{
		$currentCategory = $this->categories->getCategory($category);
		$this->isNotNull($currentCategory);
		$title = $currentCategory->title;
		$description = $currentCategory->description;
		$allAnime = $currentCategory->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentCategory', 'allAnime', 'title', 'description'));
	}

	/**
	 * @param  \App\Models\Category  $category
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function show(Category $category)
	{
		//
	}
}
