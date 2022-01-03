<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\GeoBlockRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GeoBlockAdminController extends Controller
{
	private GeoBlockRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\GeoBlockRepositoryInterfaces  $geoBlockRepositoryInterfaces
	 */
	public function __construct(GeoBlockRepositoryInterfaces $geoBlockRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $geoBlockRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$index = $this->repository->getGeoBlock(null, true)->paginate($this->paginate);

		return view($this->backend . 'geo.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'geo.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		$store = $this->repository->setGeoBlock($request);

		return $this->ifErrorAddUpdate($store, 'indexGeoAdmin', 'Ошибка сохранения');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $url): View|Factory|Application
	{
		$edit = $this->repository->getGeoBlock($url)->first();

		return view($this->backend . 'geo.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string                    $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, string $url): RedirectResponse
	{
		$update = $this->repository->setGeoBlock($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexGeoAdmin', 'Ошибка сохранения');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(string $url): RedirectResponse
	{
		$delete = $this->repository->deleteGeoBlock($url);
		if ($delete) {
			return back();
		}
	}
}
