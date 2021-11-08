<?php


namespace App\Repository\Interfaces;


use App\Http\Requests\TableOrderRequest;

interface TableOrderRepositoryInterfaces
{
	/**
	 * @param  int|null  $id
	 * @param  int|null  $user_id
	 * @param  bool      $isAdmin
	 *
	 * @return mixed
	 */
	public function getTable(int $id = null, int $user_id = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  int|null                              $id
	 *
	 * @return mixed
	 */
	public function setTable(TableOrderRequest $request, int $id = null): mixed;

	/**
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @return mixed
	 */
	public function deleteTable(int $id, bool $fullDel = false): mixed;
}