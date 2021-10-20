<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\KodikRepositoryInterfaces;
use App\Services\KodikTrait;
use Route;

class KodikAdminController extends Controller
{
	use KodikTrait;

	private KodikRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\KodikRepositoryInterfaces  $kodikRepositoryInterfaces
	 */
	public function __construct(KodikRepositoryInterfaces $kodikRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $kodikRepositoryInterfaces;
	}

	/**
	 * @param  string|null  $category
	 * @param  string|null  $page
	 */
	public function index(string $category = null, string $page = null)
	{
		$kodik = $this->repository->listKodik($category, $page);
		$active = $this->categoryTabActive($category);
		$button = $kodik['button'];
		$cat = Route::getCurrentRoute()->parameters();

		return view($this->backend . 'kodik.index', compact('kodik', 'active', 'button', 'cat'));
	}

	/**
	 * @param  string  $optionsSearch
	 * @param  string  $search
	 */
	public function search(string $optionsSearch, string $search)
	{
		$kodik = $this->repository->searchKodik($optionsSearch, $search);

		dd(__METHOD__, $kodik);
	}
}
