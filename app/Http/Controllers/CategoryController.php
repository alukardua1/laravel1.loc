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
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $url): View|Factory|Application
	{
		$show = $this->repository->getCategory($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
