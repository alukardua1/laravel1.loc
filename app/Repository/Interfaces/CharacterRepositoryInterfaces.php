<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface CharacterRepositoryInterfaces
{
	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getCharacter(string $url = null): mixed;

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setCharacter(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delCharacter(string $url, bool $fullDel = false): mixed;
}