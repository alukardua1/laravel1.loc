<?php

namespace App\Repository;

use App\Models\Group;
use App\Repository\Interfaces\GroupRepositoryInterfaces;
use Illuminate\Http\Request;

class GroupRepository implements GroupRepositoryInterfaces
{

	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getGroup(string $url = null): mixed
	{
		if ($url) {
			return Group::where('title', $url)->first();
		} else {
			return Group::orderBy('id', 'ASC');
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
		$updateGroup = Group::updateOrCreate(['title' => $url], $formRequest);
		if ($updateGroup) {
			return $updateGroup->save();
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
		$delete = Group::findOrFail($url, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}