<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\UserRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
	/**
	 * @var \App\Repository\Interfaces\UserRepositoryInterfaces
	 */
	private $user;

	/**
	 * UserController constructor.
	 *
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->keyCache = 'user_';
		$this->user = $userRepositoryInterfaces;
	}

	/**
	 * @param $user
	 *
	 * @return mixed
	 */
	protected function userCache($user)
	{
		if (Cache::has($this->keyCache . $user)) {
			$currentUser = Cache::get($this->keyCache . $user);
		} else {
			$currentUser = self::setCache($this->keyCache . $user, $this->user->getUser($user));
		}
		$this->isNotNull($currentUser);

		return $currentUser;
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
		$currentUser = $this->userCache($user);

		return view('web.frontend.user.profile', compact('currentUser'));
	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit($user)
	{
		$currentUser = $this->userCache($user);

		return view('web.frontend.user.edit', compact($currentUser));
	}

	/**
	 * @param                            $user
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function update($user, Request $request)
	{
	}
}
