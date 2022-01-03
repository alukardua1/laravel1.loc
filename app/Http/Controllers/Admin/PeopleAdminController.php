<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\PeopleRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PeopleAdminController extends Controller
{
	private PeopleRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\PeopleRepositoryInterfaces  $peopleRepositoryInterfaces
	 */
	public function __construct(PeopleRepositoryInterfaces $peopleRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $peopleRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$index = $this->repository->getPeople(null, true)->paginate($this->paginate);

		return view($this->backend . 'people.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'people.add');
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
		$store = $this->repository->setPeople($request);

		return $this->ifErrorAddUpdate($store, 'indexPeopleAdmin', 'Ошибка сохранения');
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
		$edit = $this->repository->getPeople($url)->first();

		return view($this->backend . 'people.edit', compact('edit'));
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
		$update = $this->repository->setPeople($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexPeopleAdmin', 'Ошибка сохранения');
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
		$delete = $this->repository->deletePeople($url);
		if ($delete) {
			return back();
		}
	}
}
