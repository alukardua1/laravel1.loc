<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use App\Traits\CacheTrait;
use Cache;
use Illuminate\View\View;

class MenuComposer
{
	public $menu;
	public $path;

	protected $category;
	protected $key = 'menu';

	use CacheTrait;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		$this->category = $categoryRepositoryInterfaces;
		$this->menu = $this->menu();
		$this->path = $this->path();
	}

	public function path()
	{
		return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	}

	public function menu()
	{
		if (Cache::has($this->key)) {
			$item = Cache::get($this->key);
		} else {
			$item = self::setCache($this->key, $this->category->getCategories()->get());
		}

		return $item;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 *
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('menu', $this->menu);
		$view->with('path', $this->path);
	}
}