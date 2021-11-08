<?php

namespace App\Repository;

use App\Models\People;
use App\Repository\Interfaces\PeopleRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PeopleRepository implements PeopleRepositoryInterfaces
{
	private Model $model;

	public function __construct(People $people)
	{
		$this->model = $people;
	}

	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPeople(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		} elseif ($isAdmin) {
			return $this->model->orderBy('id', 'ASC')->withTrashed();
		}
		return $this->model->orderBy('id', 'ASC');
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setPeople(Request $request, string $url = null): mixed
	{
		$formRequest = $request->all();
		$update = $this->model->updateOrCreate(['url' => $url], $formRequest);
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
	public function deletePeople(string $url, bool $fullDel = false): mixed
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