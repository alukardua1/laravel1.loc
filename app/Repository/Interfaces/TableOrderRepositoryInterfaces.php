<?php


namespace App\Repository\Interfaces;


use App\Models\User;
use Request;

/**
 * Interface TableOrderRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface TableOrderRepositoryInterfaces
{
	/**
	 * @param  \App\Models\User  $user
	 * @param  int|null          $id
	 *
	 * @return mixed
	 */
	public function get(User $user, int $id = null);

	/**
	 * @param  Request  $request
	 * @param  int      $user_id
	 *
	 * @return mixed
	 */
	public function set(Request $request, int $user_id);
}