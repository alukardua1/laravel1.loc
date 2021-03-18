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

	/**
	 * Create a menu composer.
	 *
	 * @param  CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		$this->categoryRepository = $categoryRepositoryInterfaces;
		$this->category = $this->category();
	}

	/**
	 * @return mixed
	 */
	public function category()
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