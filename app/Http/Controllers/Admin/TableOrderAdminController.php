<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableOrderRequest;
use App\Repository\Interfaces\TableOrderRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TableOrderAdminController extends Controller
{
	private TableOrderRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\TableOrderRepositoryInterfaces  $tableOrderRepositoryInterfaces
	 */
	public function __construct(TableOrderRepositoryInterfaces $tableOrderRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $tableOrderRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(): View|Factory|Application
	{
		$index = $this->repository->getTable()->paginate($this->paginate);

		return view($this->backend . 'static_page.index', compact('index'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'static_page.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(TableOrderRequest $request): RedirectResponse
	{
		$store = $this->repository->setTable($request);

		return $this->ifErrorAddUpdate($store, 'indexStaticPageAdmin', 'Ошибка сохранения');
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
		$edit = $this->repository->getTable($url)->first();

		return view($this->backend . 'static_page.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  string                                $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(TableOrderRequest $request, string $url): RedirectResponse
	{
		$update = $this->repository->setTable($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexStaticPageAdmin', 'Ошибка сохранения');
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
		$delete = $this->repository->deleteTable($url);
		if ($delete) {
			return back();
		}
	}
}
