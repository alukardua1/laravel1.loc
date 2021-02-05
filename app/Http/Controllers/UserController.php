<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

class UserController extends Controller
{
	private $user;

	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->user = $userRepositoryInterfaces;
	}

	public function index()
	{
		$users = $this->user->getUsers()->get();

		dd(__METHOD__, $users);
	}

	public function show($user)
	{
		$currentUser = $this->user->getUser($user)->first();

		$this->isNotNull($currentUser);

		return view('web.frontend.user.profile', compact('currentUser'));
	}

	public function edit($user)
	{
		$currentUser = $this->user->getUser($user)->first();

		$this->isNotNull($currentUser);
		dd(__METHOD__, $currentUser);
	}

	public function update($user, Request $request)
	{

	}
}
