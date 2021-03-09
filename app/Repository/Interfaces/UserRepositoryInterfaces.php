<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\UserRequest;

/**
 * Interface UserRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface UserRepositoryInterfaces
{
	/**
	 * @param $user
	 *
	 * @return mixed
	 */
	public function getUser($user);

	/**
	 * @return mixed
	 */
	public function getUsers();

	/**
	 * @param $user
	 *
	 * @return mixed
	 */
	public function getPM($user);

	/**
	 * @param $request
	 * @param $currentUser
	 *
	 * @return mixed
	 */
	public function setUsers($request, $currentUser);
}