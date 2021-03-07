<?php


namespace App\Repository\Interfaces;


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

	public function getPM($user);
}