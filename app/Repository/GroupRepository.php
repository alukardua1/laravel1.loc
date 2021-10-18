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
		$updateGroup = Group::firstOrCreate(['title' => $url], $formRequest);

		return $updateGroup->save();
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delGroup(string $url, bool $fullDel = false): mixed
	{
		$del = Group::findOrFail($url, ['*']);
		if ($del) {
			if ($fullDel) {
				return $del->forceDelete();
			}
			return $del->delete();
		}
	}
}