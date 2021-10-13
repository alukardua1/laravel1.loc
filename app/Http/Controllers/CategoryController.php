<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
	private CategoryRepositoryInterfaces $categoryRepository;

	/**
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		parent::__construct();
		$this->categoryRepository = $categoryRepositoryInterfaces;
	}

	/**
	 * @param  string  $categoryUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(string $categoryUrl): View|Factory|Application
	{
		$currentCategory = $this->categoryRepository->getCategory($categoryUrl)->first();
		$this->isNotNull($currentCategory);
		$title = $currentCategory->title;
		$description = $currentCategory->description;
		$allAnime = $currentCategory->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentCategory', 'allAnime', 'title', 'description'));
	}
}
