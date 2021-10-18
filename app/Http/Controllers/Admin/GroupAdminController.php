<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\GroupRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupAdminController extends Controller
{
	private GroupRepositoryInterfaces $groupRepository;

	/**
	 * @param  \App\Repository\Interfaces\GroupRepositoryInterfaces  $groupRepositoryInterfaces
	 */
	public function __construct(GroupRepositoryInterfaces $groupRepositoryInterfaces)
	{
		parent::__construct();
		$this->groupRepository = $groupRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): Factory|View|Application
	{
		$groupAll = $this->groupRepository->getGroup()->paginate($this->paginate);

		return view($this->backend . 'group/index', compact('groupAll'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'group.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		dd(__METHOD__, $request);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $group
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $group): View|Factory|Application
	{
		$groupEdit = $this->groupRepository->getGroup($group);

		return view($this->backend . 'group.edit', compact('groupEdit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string                    $group
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, string $group): Response
	{
		dd(__METHOD__, $request, $group);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $group
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(string $group)
	{
		dd(__METHOD__, $group);
	}
}
