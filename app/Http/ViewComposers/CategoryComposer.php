<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\View\View;

/**
 * Class MenuComposer
 *
 * @package App\Http\ViewComposers
 */
class CategoryComposer
{
	public                                 $category;
	protected CategoryRepositoryInterfaces $categoryRepository;
	public int                             $i = 0;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		$this->categoryRepository = $categoryRepositoryInterfaces;
		$this->category = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->categoryRepository->getCategories()->get();
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
		$view->with('category', $this->category);
	}
}