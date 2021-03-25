<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface UserRepositoryInterfaces
{
	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function getUser(string $login): mixed;

	/**
	 * @return mixed
	 */
	public function getUsers(): mixed;

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function getPM(string $login): mixed;

	/**
	 * @param  Request  $request
	 * @param  string   $login
	 *
	 * @return mixed
	 */
	public function setUsers(Request $request, string $login): mixed;
}