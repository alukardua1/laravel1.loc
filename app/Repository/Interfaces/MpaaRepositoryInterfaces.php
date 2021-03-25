<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface MpaaRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface MpaaRepositoryInterfaces
{
	/**
	 * @param  string  $mpaaUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $mpaaUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getMpaa(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setMpaa(string $name, Request $request): mixed;
}