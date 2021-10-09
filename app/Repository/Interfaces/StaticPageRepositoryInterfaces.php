<?php

namespace App\Repository\Interfaces;

interface StaticPageRepositoryInterfaces
{
	/**
	 * @param  string|null  $page
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPage(string $page = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \Request  $request
	 * @param  string    $page
	 *
	 * @return mixed
	 */
	public function setPage(\Request $request, string $page): mixed;

	/**
	 * @param  string  $page
	 *
	 * @return mixed
	 */
	public function delPage(string $page): mixed;
}