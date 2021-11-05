<?php


namespace App\Repository;


use App\Http\Requests\TableOrderRequest;
use App\Models\TableOrder;
use App\Repository\Interfaces\TableOrderRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

class TableOrderRepository implements TableOrderRepositoryInterfaces
{
	private Model $model;

	public function __construct(TableOrder $tableOrder)
	{
		$this->model = $tableOrder;
	}

	/**
	 * Выводит записи
	 *
	 * @param  int|null  $id
	 * @param  int|null  $user_id
	 *
	 * @return mixed
	 */
	public function getTable(int $id = null, int $user_id = null): mixed
	{
		if ($id and $user_id) {
			return $this->model->where(['id', $id], ['user_id', $user_id]);
		} else {
			return $this->model->where('user_id', $user_id);
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
	public function setTable(TableOrderRequest $request, int $id = null): mixed
	{
		$formRequest = $request->all();
		$update = $this->model->firstOrCreate(['id' => $id], $formRequest);

		if ($update) {
			return $update->save();
		}
	}

	/**
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @return mixed
	 */
	public function deleteTable(int $id, bool $fullDel = false): mixed
	{
		$delete = $this->model->findOrFail($id, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}