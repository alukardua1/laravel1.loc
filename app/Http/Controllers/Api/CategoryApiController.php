<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryApiController extends Controller
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

	public function index()
	{
		$result = $this->repository->getCategory()->paginate($this->paginate);
		//$result = $this->animeAllMutations($result);

		return response()->json($result);
	}

	public function show(string $category)
	{
	}
}
