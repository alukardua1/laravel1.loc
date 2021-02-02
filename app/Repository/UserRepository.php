<?php


namespace App\Repository;


use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;

class UserRepository implements UserRepositoryInterfaces
{
	public function getUser($user)
	{
		return User::with(['getGroup:id,title,description', 'getAnime'])->where('login', $user);
	}

	public function getUsers()
	{
		return User::with(['getGroup:id,title,description', 'getAnime']);
	}
}