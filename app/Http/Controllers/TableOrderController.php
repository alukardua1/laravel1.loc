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
        return view($this->frontend . 'order.order_show');
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
	 * @return \Illuminate\Http\Response
	 */
    public function store(TableOrderRequest $request)
    {
        dd(__METHOD__, \Auth::user()->id, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TableOrder  $tableOrder
     * @return \Illuminate\Http\Response
     */
    public function show(TableOrder $tableOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TableOrder  $tableOrder
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TableOrder $tableOrder)
    {
	    return view($this->frontend . 'order.order_edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TableOrder  $tableOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableOrder $tableOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TableOrder  $tableOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableOrder $tableOrder)
    {
        //
    }
}
