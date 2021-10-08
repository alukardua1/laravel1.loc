<?php

namespace App\Repository\Interfaces;

interface GroupRepositoryInterfaces
{
	/**
	 * @param  null  $group
	 *
	 * @return mixed
	 */
	public function getGroup($group = null);

	/**
	 * @param  \Request  $request
	 * @param  string    $group
	 *
	 * @return mixed
	 */
	public function setGroup(\Request $request, string $group);

	public function delGroup($group);
}