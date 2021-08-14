<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableOrderRequest;
use App\Models\TableOrder;
use App\Models\User;
use App\Repository\Interfaces\TableOrderRepositoryInterfaces;
use Illuminate\Http\Request;

class TableOrderController extends Controller
{
	protected $tableOrderRepository;

	public function __construct(TableOrderRepositoryInterfaces $tableOrderRepositoryInterfaces)
	{
		parent::__construct();
		$this->tableOrderRepository = $tableOrderRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index()
	{
		$allTableOrder = $this->tableOrderRepository->get(null, \Auth::id())->paginate($this->paginate);
		return view($this->frontend . 'order.order_show', compact('allTableOrder'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create()
	{
		return view($this->frontend . 'order.order_add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
	 */
	public function store(TableOrderRequest $request)
	{
		$tableOrder = $this->tableOrderRepository->set($request);
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
	public function show(int $id)
	{
		$tableOrderShow = $this->tableOrderRepository->get($id, \Auth::id())->first();
		return view($this->frontend . 'order.order_edit', compact('tableOrderShow'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
	 */
	public function edit(int $id)
	{
		if (in_array(\Auth::user()->group_id, [1, 2])) {
			$currentTableOrder = $this->tableOrderRepository->get($id);
			return view($this->frontend . 'order.order_edit', compact('currentTableOrder'));
		}

		return abort(404);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\TableOrderRequest  $request
	 * @param                                        $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @todo доработать
	 */
	public function update(TableOrderRequest $request, $id)
	{
		$tableOrder = $this->tableOrderRepository->set($request, $id);
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
