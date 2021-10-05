<?php

namespace App\Repository\Interfaces;

interface StaticPageRepositoryInterfaces
{
	public function getPage($page);

	public function setPage(\Request $request, $page = null);
}