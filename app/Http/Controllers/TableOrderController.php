<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableOrderRequest;
use App\Models\TableOrder;
use App\Repository\Interfaces\TableOrderRepositoryInterfaces;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TableOrderController extends Controller
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
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$allTableOrder = $this->repository->get(null, Auth::id())->paginate($this->paginate);

		return view($this->frontend . 'order.show', compact('allTableOrder'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->frontend . 'order.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function store(TableOrderRequest $request): Response|RedirectResponse
	{
		$tableOrder = $this->repository->set($request);
		if ($tableOrder) {
			return redirect()->route('tableOrder');
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(int $id): View|Factory|Application
	{
		$tableOrderShow = $this->repository->get($id, Auth::id())->first();
		return view($this->frontend . 'order.edit', compact('tableOrderShow'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(int $id): View|Factory|Application
	{
		if (in_array(Auth::user()->group_id, [1, 2])) {
			$currentTableOrder = $this->repository->get($id);
			return view($this->frontend . 'order.edit', compact('currentTableOrder'));
		}

		return abort(404);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param  int                                   $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @todo доработать
	 */
	public function update(TableOrderRequest $request, int $id): RedirectResponse
	{
		$tableOrder = $this->repository->set($request, $id);
		if ($tableOrder) {
			return redirect()->route('tableOrder');
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\TableOrder  $tableOrder
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(TableOrder $tableOrder)
	{
		//
	}
}
