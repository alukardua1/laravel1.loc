<?php


namespace App\Http\ViewComposers;



use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\View\View;

class UserComposer
{
	public    $user;
	protected $userRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->userRepository = $userRepositoryInterfaces;
		$this->user = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
	{
		return $this->userRepository->getUsers();
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
		$view->with('user', $this->user);
	}
}