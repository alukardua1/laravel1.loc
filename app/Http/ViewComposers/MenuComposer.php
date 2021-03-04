<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\View\View;

/**
 * Class MenuComposer
 *
 * @package App\Http\ViewComposers
 */
class MenuComposer
{
	public    $menu;
	public    $path;
	protected $category;

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

	/**
	 * @return mixed
	 */
	public function path()
	{
		return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->category->getCategories()->get();
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