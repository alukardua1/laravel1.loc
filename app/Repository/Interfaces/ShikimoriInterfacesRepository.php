<?php


namespace App\Repository\Interfaces;


/**
 * Interface ShikimoriInterfacesRepository
 *
 * @package App\Repository\Interfaces
 */
interface ShikimoriInterfacesRepository
{
	/**
	 * @param  string  $id
	 *
	 * @return mixed
	 */
	public function getShikimori(string $id);
}