<?php

namespace App\Repository;

use App\Repository\Interfaces\CharacterRepositoryInterfaces;
use Illuminate\Http\Request;

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
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setCharacter(Request $request, string $url = null): mixed
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