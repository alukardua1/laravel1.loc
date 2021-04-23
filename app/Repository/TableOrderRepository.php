<?php


namespace App\Repository;


use App\Models\User;
use App\Repository\Interfaces\TableOrderRepositoryInterfaces;
use Request;

/**
 * Class TableOrderRepository
 *
 * @package App\Repository
 */
class TableOrderRepository implements TableOrderRepositoryInterfaces
{
	/**
	 * @param  \App\Models\User  $user
	 * @param  int|null          $id
	 *
	 * @return mixed|void
	 */
	public function get(User $user, int $id = null)
	{
		// TODO: Implement get() method.
	}

	/**
	 * @param  \Request  $request
	 * @param  int       $user_id
	 *
	 * @return mixed|void
	 */
	public function set(Request $request, int $user_id)
	{
		// TODO: Implement set() method.
	}
}