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
			return Group::with('name', $group)->first();
		} else {
			return Group::orderBy('id', 'ASC');
		}
	}

	/**
	 * @param  \Request  $request
	 * @param            $group
	 */
	public function setGroup(\Request $request, $group)
	{
		// TODO: Implement setGroup() method.
	}
}