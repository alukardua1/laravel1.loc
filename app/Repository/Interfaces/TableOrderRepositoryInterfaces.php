<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\TableOrderRequest;

interface TableOrderRepositoryInterfaces
{
	/**
	 * @param  int|null  $id
	 * @param  int|null  $user_id
	 *
	 * @return mixed
	 */
	public function get(int $id = null, int $user_id = null): mixed;

	/**
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  int|null                              $id
	 *
	 * @return mixed
	 */
	public function set(TableOrderRequest $request, int $id = null): mixed;

	/**
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @return mixed
	 */
	public function del(int $id, bool $fullDel = false): mixed;
}