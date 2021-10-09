<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryApiController extends Controller
{
	protected CategoryRepositoryInterfaces $categoryRepository;

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
