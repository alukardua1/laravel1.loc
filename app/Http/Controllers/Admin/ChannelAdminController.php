<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ChannelAdminController extends Controller
{
	private ChannelRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $channelRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(): View|Factory|Application
	{
		$channel = $this->repository->getChannel()->paginate($this->paginate);

		return view($this->backend . 'channel.index', compact($channel));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create(): View|Factory|Application
	{
		return view($this->backend . 'channel.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\ChannelRequest  $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(ChannelRequest $request)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(string $url)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\ChannelRequest  $request
	 * @param  string                             $url
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(ChannelRequest $request, string $url)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $url
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(string $url)
	{
		//
	}
}
