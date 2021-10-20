<?php

namespace App\Repository;

use App\Http\Requests\CharacterRequest;
use App\Repository\Interfaces\CharacterRepositoryInterfaces;

class CharacterRepository implements CharacterRepositoryInterfaces
{

	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCharacter(string $url = null): mixed
	{
		// TODO: Implement getCharacter() method.
	}

	/**
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 * @param  string|null                          $url
	 *
	 * @return mixed
	 */
	public function setCharacter(CharacterRequest $request, string $url = null): mixed
	{
		// TODO: Implement setCharacter() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delCharacter(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delCharacter() method.
	}
}