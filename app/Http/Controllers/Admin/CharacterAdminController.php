<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharacterRequest;
use App\Repository\Interfaces\CharacterRepositoryInterfaces;

class CharacterAdminController extends Controller
{
	private CharacterRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\CharacterRepositoryInterfaces  $characterRepositoryInterfaces
	 */
	public function __construct(CharacterRepositoryInterfaces $characterRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $characterRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CharacterRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\CharacterRequest  $request
	 * @param  int                                  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(CharacterRequest $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
