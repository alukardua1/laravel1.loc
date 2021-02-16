<?php

namespace App\Http\Controllers;

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

	public function index()
	{
		$categoryAll = $this->categories->getCategories()->get();

		dd(__METHOD__, $categoryAll);
	}

	/**
	 * @param $category
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($category)
	{
		$currentCategory = $this->categories->getCategory($category);
		$allAnime = $currentCategory->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentCategory', 'allAnime'));
	}
}
