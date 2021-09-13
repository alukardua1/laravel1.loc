<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

/**
 *
 */
interface StaticPageRepositoryInterfaces
{
	/**
	 * @param  null  $url
	 *
	 * @return mixed
	 */
	public function getPage($url = null);

	/**
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return mixed
	 */
	public function setPage(Request $request);
}