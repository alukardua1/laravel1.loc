<?php

namespace App\Repository;

use Illuminate\Http\Request;

/**
 *
 */
class StaticPageRepository implements Interfaces\StaticPageRepositoryInterfaces
{

	/**
	 * @param  null  $url
	 *
	 * @return mixed|void
	 */
	public function getPage($url = null)
	{
		// TODO: Implement getPage() method.
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return mixed|void
	 */
	public function setPage(Request $request)
	{
		// TODO: Implement setPage() method.
	}
}