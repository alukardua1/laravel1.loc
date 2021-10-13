<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\KodikRepositoryInterfaces;

class KodikAdminController extends Controller
{
	protected KodikRepositoryInterfaces $kodikRepository;

	/**
	 * @param  \App\Repository\Interfaces\KodikRepositoryInterfaces  $kodikRepositoryInterfaces
	 */
	public function __construct(KodikRepositoryInterfaces $kodikRepositoryInterfaces)
	{
		parent::__construct();
		$this->kodikRepository = $kodikRepositoryInterfaces;
	}

	/**
	 * @param  string|null  $category
	 * @param  string|null  $page
	 */
	public function index(string $category = null, string $page = null)
	{
		$kodik = $this->kodikRepository->listKodik($category, $page);

		dd(__METHOD__, $kodik);
	}

	/**
	 * @param  string  $optionsSearch
	 * @param  string  $search
	 */
	public function search(string $optionsSearch, string $search)
	{
		$kodik = $this->kodikRepository->searchKodik($optionsSearch, $search);

		dd(__METHOD__, $kodik);
	}
}
