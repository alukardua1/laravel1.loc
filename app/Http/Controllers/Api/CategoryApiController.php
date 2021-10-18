<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryApiController extends Controller
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

	public function index()
	{
	}

	public function show(string $category)
	{
	}
}
