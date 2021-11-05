<?php

namespace App\Repository;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Repository\Interfaces\CharacterRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

class CharacterRepository implements CharacterRepositoryInterfaces
{
	private Model $model;

	public function __construct(Character $character)
	{
		$this->model = $character;
	}

	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCharacter(string $url = null): mixed
	{
		if ($url) {
			return $this->model->where('url', $url);
		}
		return $this->model->orderBy('title', 'ASC');
	}

	/**
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 * @param  string|null                          $url
	 *
	 * @return mixed
	 */
	public function setCharacter(CharacterRequest $request, string $url = null): mixed
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
	public function deleteCharacter(string $url, bool $fullDel = false): mixed
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