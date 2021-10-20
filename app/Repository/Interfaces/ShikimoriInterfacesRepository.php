<?php


namespace App\Repository\Interfaces;

interface ShikimoriInterfacesRepository
{
	/**
	 * @param  string  $id
	 *
	 * @return mixed
	 */
	public function getShikimori(string $id): mixed;
}