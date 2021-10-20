<?php


namespace App\Http\ViewComposers;



use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\View\View;

class UserComposer
{
	private UserRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->repository = $userRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getUser()->get();
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
		$view->with('user', $this->view());
	}
}