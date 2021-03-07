<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
	private $user;

	/**
	 * UserController constructor.
	 *
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		parent::__construct();
		$this->user = $userRepositoryInterfaces;
	}

	/**
	 *
	 */
	public function index()
	{
		$users = $this->user->getUsers();

		dd(__METHOD__, $users);
	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($user)
	{
		$currentUser = $this->user->getUser($user);

		return view($this->frontend . 'user.profile', compact('currentUser'));
	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit($user)
	{
		$currentUser = $this->user->getUser($user);

		return view('web.frontend.user.edit', compact('currentUser'));
	}

	/**
	 * @param                            $user
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function update($user, Request $request)
	{
	}

	public function showAnime($user)
	{
		$currentUser = $this->user->getUser($user);
		$this->isNotNull($currentUser);
		$title = "Аниме добавленое пользователем {$currentUser->login}";
		$description = '';
		$allAnime = $currentUser->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentUser', 'allAnime', 'title', 'description'));
	}
}
