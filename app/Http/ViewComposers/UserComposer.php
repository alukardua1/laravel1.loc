<?php


namespace App\Http\ViewComposers;



use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\View\View;

class UserComposer
{
	protected mixed                       $user;
	protected UserRepositoryInterfaces $userRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->userRepository = $userRepositoryInterfaces;
		$this->user = $this->user();
	}

	/**
	 * @return mixed
	 */
	public function user(): mixed
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