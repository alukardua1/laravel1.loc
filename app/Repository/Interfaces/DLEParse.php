<?php


namespace App\Repository\Interfaces;


/**
 * Interface DLEParse
 *
 * @package App\Repository\Interfaces
 */
interface DLEParse
{
	/**
	 * @return mixed
	 */
	public function parseCategory(): mixed;

	/**
	 * @return mixed
	 */
	public function parseUser(): mixed;

	/**
	 * @param  int|null  $id
	 *
	 * @return mixed
	 */
	public function parsePost(int $id = null): mixed;

	/**
	 * @return mixed
	 */
	public function parsePostCategory(): mixed;

	/**
	 * @return mixed
	 */
	public function parseComments(): mixed;

	/**
	 * @return mixed
	 */
	public function parseStudio(): mixed;

	/**
	 * @return mixed
	 */
	public function parsePerson(): mixed;

	/**
	 * @return mixed
	 */
	public function parseChannel(): mixed;

	/**
	 * @param  string  $url
	 *
	 * @return mixed
	 */
	public function parseKodik(string $url): mixed;

	/**
	 * @param  string  $url
	 *
	 * @return mixed
	 */
	public function parseKodikQuality(string $url): mixed;
}
