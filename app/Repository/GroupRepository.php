<?php

namespace App\Repository;

use App\Models\Group;
use Request;

class GroupRepository implements Interfaces\GroupRepositoryInterfaces
{

	/**
	 * @param  string|null  $group
	 *
	 * @return mixed
	 */
	public function getGroup(string $group = null): mixed
	{
		if ($group) {
			return Group::where('title', $group)->first();
		} else {
			return Group::orderBy('id', 'ASC');
		}
	}

	/**
	 * @param  \Request  $request
	 * @param  string    $group
	 *
	 * @return mixed
	 */
	public function setGroup(Request $request, string $group): mixed
	{
		$formRequest = $request->all();
		$updateGroup = Group::firstOrCreate(['title' => $group], $formRequest);

		return $updateGroup->save();
	}

	/**
	 * @param  string  $group
	 *
	 * @return mixed
	 */
	public function delGroup(string $group): mixed
	{
		$del = Group::findOrFail($group, ['*']);
		if ($del) {
			return $del->forceDelete();
		}
	}
}