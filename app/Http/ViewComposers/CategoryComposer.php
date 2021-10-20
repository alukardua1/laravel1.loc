<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\View\View;

class CategoryComposer
{
	private CategoryRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\CategoryRepositoryInterfaces  $categoryRepositoryInterfaces
	 */
	public function __construct(CategoryRepositoryInterfaces $categoryRepositoryInterfaces)
	{
		$this->repository = $categoryRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getCategory()->get();
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
		$view->with('category', $this->view());
	}
}