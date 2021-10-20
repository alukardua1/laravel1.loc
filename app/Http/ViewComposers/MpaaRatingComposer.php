<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\MpaaRepositoryInterfaces;
use Illuminate\View\View;

class MpaaRatingComposer
{
	private MpaaRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\MpaaRepositoryInterfaces  $mpaaRepositoryInterfaces
	 */
	public function __construct(MpaaRepositoryInterfaces $mpaaRepositoryInterfaces)
	{
		$this->repository = $mpaaRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getMpaa()->get();
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
		$view->with('mpaa', $this->view());
	}
}