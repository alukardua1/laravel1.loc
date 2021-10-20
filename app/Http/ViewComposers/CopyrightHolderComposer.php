<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces;
use Illuminate\View\View;

class CopyrightHolderComposer
{
	private CopyrightHolderRepositoryInterfaces $repository;

	/**
	 * CopyrightHolderComposer constructor.
	 *
	 * @param  \App\Repository\Interfaces\CopyrightHolderRepositoryInterfaces  $copyrightHolderRepositoryInterfaces
	 */
	public function __construct(CopyrightHolderRepositoryInterfaces $copyrightHolderRepositoryInterfaces)
	{
		$this->repository = $copyrightHolderRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getCopyrightHolder()->get();
	}

	/**
	 * @param  \Illuminate\View\View  $view
	 */
	public function compose(View $view)
	{
		$view->with('copyrightHolder', $this->view());
	}
}