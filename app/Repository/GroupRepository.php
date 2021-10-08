<?php

namespace App\Repository;

use App\Models\Group;

class GroupRepository implements Interfaces\GroupRepositoryInterfaces
{

	/**
	 * @param  null  $group
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
	 */
	public function getGroup($group = null)
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
	 */
	public function setGroup(\Request $request, string $group)
	{
		$formRequest = $request->all();
		$updateGroup = Group::firstOrCreate(['title' => $group], $formRequest);

		return $updateGroup->save();
	}

	public function delGroup($group)
	{
		$del = Group::findOrFail($group, ['*']);
		if ($del) {
			return $del->forceDelete();
		}
	}
}