<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\TableOrderRequest;
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
	 * @param  int|null  $id
	 * @param  int|null  $user_id
	 *
	 * @return mixed
	 */
	public function get(int $id = null, int $user_id = null);

	/**
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  int|null                              $user_id
	 * @param  int|null                              $id
	 *
	 * @return mixed
	 */
	public function set(TableOrderRequest $request, int $user_id = null, int $id = null);
}