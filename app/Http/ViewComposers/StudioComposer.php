<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\StudioRepositoryInterfaces;
use Illuminate\View\View;

class StudioComposer
{
	private StudioRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\StudioRepositoryInterfaces  $studioRepositoryInterfaces
	 */
	public function __construct(StudioRepositoryInterfaces $studioRepositoryInterfaces)
	{
		$this->repository = $studioRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getStudio()->get();
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
		$view->with('studios', $this->view());
	}
}