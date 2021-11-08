<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface PeopleRepositoryInterfaces
{
	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPeople(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setPeople(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deletePeople(string $url, bool $fullDel = false): mixed;
}