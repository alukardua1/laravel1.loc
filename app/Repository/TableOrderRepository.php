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
	 * @param  int|null  $id
	 * @param  int|null  $user_id
	 *
	 * @return mixed|void
	 */
	public function get(int $id = null, int $user_id = null)
	{
		if ($user_id) {
			return TableOrder::where('user_id', $user_id);
		} elseif ($id) {
			return TableOrder::where('id', $id);
		} else {
			return TableOrder::all();
		}
	}

	/**
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  int|null                              $user_id
	 * @param  int|null                              $id
	 *
	 * @return mixed|void
	 */
	public function set(TableOrderRequest $request, int $user_id = null, int $id = null)
	{
		$formRequest = $request->all();
		if (!key_exists('user_id', $formRequest)) {
			$formRequest['user_id'] = $user_id;
		}
		$update = TableOrder::firstOrCreate(['id' => $id], $formRequest);
		if ($update) {
			return $update->save();
		}
	}
}