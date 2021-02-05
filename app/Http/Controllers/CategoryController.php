<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	private   $categories;
	protected $pagination;

	public function __construct(CategoryRepositoryInterfaces $categoryRepository)
	{
		$this->keyCache = 'category_';
		$this->paginate = env('APP_PAGINATE', 10);
		$this->categories = $categoryRepository;
	}

	public function index()
	{
		$categoryAll = $this->categories->getCategories()->get();

		dd(__METHOD__, $categoryAll);
	}

	public function show($category, Request $request)
	{
		$page = 'page_' . $request->get('page', 1);
		if (Cache::has($this->keyCache . $page) and Cache::has($this->keyCache . $category)) {
			$currentCategory = Cache::get($this->keyCache . $category);
			$allAnime = Cache::get($this->keyCache . $page);
		} else {
			$currentCategory = self::setCache($this->keyCache . $category, $this->categories->getCategory($category)->first());
			$allAnime = self::setCache($this->keyCache . $page, $currentCategory->getAnime()->paginate($this->paginate));
		}

		return view('web.frontend.anime.short', compact('currentCategory', 'allAnime'));
	}
}
