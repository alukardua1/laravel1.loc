<?php

namespace App\Repository;

use App\Models\Group;
use App\Repository\Interfaces\GroupRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GroupRepository implements GroupRepositoryInterfaces
{
	private Model $model;

	public function __construct(Group $group)
	{
		$this->model = $group;
	}

	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getGroup(string $url = null): mixed
	{
		if ($url) {
			return $this->model->where('title', $url)->first();
		} else {
			return $this->model->orderBy('id', 'ASC');
		}
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setGroup(Request $request, string $url = null): mixed
	{
		$formRequest = $request->all();
		$update = $this->model->updateOrCreate(['title' => $url], $formRequest);
		if ($update) {
			return $update->save();
		}
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteGroup(string $url, bool $fullDel = false): mixed
	{
		$delete = $this->model->findOrFail($url, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}