<?php

namespace App\Repository;

use App\Models\People;
use App\Repository\Interfaces\PeopleRepositoryInterfaces;
use Illuminate\Http\Request;

class PeopleRepository implements PeopleRepositoryInterfaces
{

	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getPeople(string $url = null): mixed
	{
		if ($url) {
			return People::where('url', $url);
		}
		return People::orderBy('id', 'ASC');
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setPeople(Request $request, string $url = null): mixed
	{
		// TODO: Implement setPeople() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deletePeople(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delPeople() method.
	}
}