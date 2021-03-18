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
	private CategoryRepositoryInterfaces $categoryRepository;

	/**
	 * CategoryController constructor.
	 *
	 * @param  CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		parent::__construct();
		$this->categoryRepository = $categoryRepositoryInterfaces;
	}

	/**
	 * @param string $categoryUrl
	 *
	 * @return mixed
	 */
	public function index(string $categoryUrl)
	{
		$currentCategory = $this->categoryRepository->getCategory($categoryUrl)->first();
		$this->isNotNull($currentCategory);
		$title = $currentCategory->title;
		$description = $currentCategory->description;
		$allAnime = $currentCategory->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentCategory', 'allAnime', 'title', 'description'));
	}
}
