<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface PeopleRepositoryInterfaces
{
	public function getPeople(string $url = null): mixed;

	public function setPeople(Request $request, string $url): mixed;

	public function delPeople(string $url): mixed;
}