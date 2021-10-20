<?php


namespace App\Http\ViewComposers;

use App\Repository\Interfaces\YearAiredRepositoryInterfaces;
use Illuminate\View\View;

class YearComposer
{
	private YearAiredRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\YearAiredRepositoryInterfaces  $yearAiredRepositoryInterfaces
	 */
	public function __construct(YearAiredRepositoryInterfaces $yearAiredRepositoryInterfaces)
	{
		$this->repository = $yearAiredRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getYearAired()->get();
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
		$view->with('year', $this->view());
	}
}