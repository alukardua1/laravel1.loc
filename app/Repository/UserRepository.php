<?php


namespace App\Repository;


use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;

/**
 * Class UserRepository
 *
 * @package App\Repository
 */
class UserRepository implements UserRepositoryInterfaces
{
	/**
	 * @param $user
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getUser($user)
	{
		return User::latest()
			->where('login', $user)
			->firstOrFail();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder|mixed
	 */
	public function getUsers()
	{
		return User::latest()
			->get();
	}
}