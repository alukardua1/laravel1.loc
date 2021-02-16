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

		return view('web.frontend.user.profile', compact('currentUser'));
	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit($user)
	{
		$currentUser = $this->user->getUser($user);

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
