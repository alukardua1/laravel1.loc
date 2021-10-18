<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface GroupRepositoryInterfaces
{
	/**
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getGroup(string $url = null): mixed;

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setGroup(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delGroup(string $url, bool $fullDel = false): mixed;
}