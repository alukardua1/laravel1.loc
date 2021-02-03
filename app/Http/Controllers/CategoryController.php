<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
	private   $categories;
	protected $pagination;

	public function __construct(CategoryRepositoryInterfaces $categoryRepository)
	{
		$this->paginate = env('APP_PAGINATE', 10);
		$this->categories = $categoryRepository;
	}

	public function index()
	{
		$categoryAll = $this->categories->getCategories()->get();

		dd(__METHOD__, $categoryAll);
	}

	public function show($category)
	{
		$currentCategory = $this->categories->getCategory($category)->first();
		$allAnime = $currentCategory->getAnime()->paginate($this->paginate);

		return view('web.frontend.anime.short', compact('currentCategory', 'allAnime'));
	}
}
