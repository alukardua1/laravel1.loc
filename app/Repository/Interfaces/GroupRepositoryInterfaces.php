<?php

namespace App\Repository\Interfaces;

interface GroupRepositoryInterfaces
{
	/**
	 * @param  string|null  $group
	 *
	 * @return mixed
	 */
	public function getGroup(string $group = null);

	/**
	 * @param  \Request  $request
	 * @param  string    $group
	 *
	 * @return mixed
	 */
	public function setGroup(\Request $request, string $group);

	/**
	 * @param  string  $group
	 *
	 * @return mixed
	 */
	public function delGroup(string $group);
}