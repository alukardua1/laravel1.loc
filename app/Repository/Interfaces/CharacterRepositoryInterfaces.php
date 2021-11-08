<?php

namespace App\Repository\Interfaces;

use App\Http\Requests\CharacterRequest;

interface CharacterRepositoryInterfaces
{
	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getCharacter(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 * @param  string|null                          $url
	 *
	 * @return mixed
	 */
	public function setCharacter(CharacterRequest $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteCharacter(string $url, bool $fullDel = false): mixed;
}