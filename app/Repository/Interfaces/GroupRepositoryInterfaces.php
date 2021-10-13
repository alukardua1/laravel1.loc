<?php

namespace App\Repository\Interfaces;

use Request;

interface GroupRepositoryInterfaces
{
	/**
	 * @param  string|null  $group
	 *
	 * @return mixed
	 */
	public function getGroup(string $group = null): mixed;

	/**
	 * @param  \Request  $request
	 * @param  string    $group
	 *
	 * @return mixed
	 */
	public function setGroup(Request $request, string $group): mixed;

	/**
	 * @param  string  $group
	 *
	 * @return mixed
	 */
	public function delGroup(string $group): mixed;
}