<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface StaticPageRepositoryInterfaces
{
	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getPage(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setPage(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deletePage(string $url, bool $fullDel = false): mixed;
}