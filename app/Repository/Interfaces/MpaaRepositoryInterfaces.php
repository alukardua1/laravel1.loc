<?php


namespace App\Repository\Interfaces;


interface MpaaRepositoryInterfaces
{
	/**
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind);

	/**
	 * @return mixed
	 */
	public function getMpaa();
}