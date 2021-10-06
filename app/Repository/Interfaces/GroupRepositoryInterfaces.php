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
	 * @param            $group
	 *
	 * @return mixed
	 */
	public function setGroup(\Request $request, $group);
}