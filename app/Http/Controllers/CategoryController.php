<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
	/**
	 * @var \App\Repository\Interfaces\CategoryRepositoryInterfaces
	 */
	private   $categories;
	/**
	 * @var
	 */
	protected $pagination;

	/**
	 * CategoryController constructor.
	 *
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		$this->keyCache = 'category_';
		$this->paginate = env('APP_PAGINATE', 10);
		$this->categories = $categoryRepositoryInterfaces;
	}

	/**
	 *
	 */
	public function index()
	{
		$categoryAll = $this->categories->getCategories()->get();

		dd(__METHOD__, $categoryAll);
	}

	/**
	 * @param                            $category
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($category, Request $request)
	{
		$page = 'page_' . $request->get('page', 1);
		if (Cache::has($this->keyCache . $page) and Cache::has($this->keyCache . $category)) {
			$currentCategory = Cache::get($this->keyCache . $category);
			$allAnime = Cache::get($this->keyCache . $page);
		} else {
			$currentCategory = self::setCache($this->keyCache . $category, $this->categories->getCategory($category));
			$allAnime = self::setCache($this->keyCache . $page, $currentCategory->getAnime()->paginate($this->paginate));
		}

		return view('web.frontend.anime.short', compact('currentCategory', 'allAnime'));
	}
}
