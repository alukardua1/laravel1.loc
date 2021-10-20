<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
	private CategoryRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $categoryRepositoryInterfaces;
	}

	/**
	 * @param  string  $categoryUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $categoryUrl): View|Factory|Application
	{
		$currentCategory = $this->repository->getCategory($categoryUrl)->first();
		$this->isNotNull($currentCategory);
		$title = $currentCategory->title;
		$description = $currentCategory->description;
		$allAnime = $currentCategory->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentCategory', 'allAnime', 'title', 'description'));
	}
}
