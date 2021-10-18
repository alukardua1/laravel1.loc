<?php

namespace App\Repository;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleRepository implements Interfaces\PeopleRepositoryInterfaces
{

	public function getPeople(string $url = null): mixed
	{
		if ($url) {
			return People::where('url', $url);
		}
		return People::orderBy('id', 'ASC');
	}

	public function setPeople(Request $request, string $url): mixed
	{
		// TODO: Implement setPeople() method.
	}

	public function delPeople(string $url): mixed
	{
		// TODO: Implement delPeople() method.
	}
}