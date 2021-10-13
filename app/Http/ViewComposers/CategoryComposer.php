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
	private mixed                        $category;
	private CategoryRepositoryInterfaces $categoryRepository;

	/**
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		$this->categoryRepository = $categoryRepositoryInterfaces;
		$this->category = $this->category();
	}

	/**
	 * @return mixed
	 */
	public function category(): mixed
	{
		return $this->categoryRepository->getCategory()->get();
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