<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface FaqRepositoryInterfaces
{
	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getFaq(string $url = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setFaq(Request $request, string $url = null): mixed;

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delFaq(string $url, bool $fullDel = false): mixed;
}