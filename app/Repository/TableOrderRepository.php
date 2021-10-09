<?php


namespace App\Repository;


use App\Http\Requests\TableOrderRequest;
use App\Models\TableOrder;
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
	 * Выводит записи
	 *
	 * @param  int|null  $id
	 * @param  int|null  $user_id
	 *
	 * @return mixed
	 */
	public function get(int $id = null, int $user_id = null): mixed
	{
		if ($id and $user_id) {
			return TableOrder::where(['id', $id], ['user_id', $user_id]);
		} else {
			return TableOrder::where('user_id', $user_id);
		}
	}

	/**
	 * Сохраняет запись
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  int|null                              $id
	 *
	 * @return mixed
	 */
	public function set(TableOrderRequest $request, int $id = null): mixed
	{
		$formRequest = $request->all();
		$update = TableOrder::firstOrCreate(['id' => $id], $formRequest);

		if ($update) {
			return $update->save();
		}
	}

	/**
	 * @param  int|null  $id
	 *
	 * @return mixed
	 */
	public function del(int $id = null): mixed
	{
		// TODO: Implement del() method.
	}
}