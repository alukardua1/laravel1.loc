<?php

namespace App\Repository\Interfaces;

interface StaticPageRepositoryInterfaces
{
	public function getPage(string $page = null);

	public function setPage(\Request $request, $page);
}