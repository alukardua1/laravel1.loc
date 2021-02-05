<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\UserRepositoryInterfaces;
use Cache;
use Illuminate\Http\Request;

class UserController extends Controller
{
	private $user;

	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->keyCache = 'user_';
		$this->user = $userRepositoryInterfaces;
	}

	protected function userCache($user)
	{
		if (Cache::has($this->keyCache . $user)) {
			$currentUser = Cache::get($this->keyCache . $user);
		} else {
			$currentUser = self::setCache($this->keyCache . $user, $this->user->getUser($user)->first());
		}
		$this->isNotNull($currentUser);

		return $currentUser;
	}

	public function index()
	{
		$users = $this->user->getUsers()->get();

		dd(__METHOD__, $users);
	}

	public function show($user)
	{
		$currentUser = $this->userCache($user);

		return view('web.frontend.user.profile', compact('currentUser'));
	}

	public function edit($user)
	{
		$currentUser = $this->userCache($user);

		return view('web.frontend.user.edit', compact($currentUser));
	}

	public function update($user, Request $request)
	{
	}
}
