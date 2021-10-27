<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
		$index = $this->repository->getChannel()->paginate($this->paginate);

		return view($this->backend . 'channel.index', compact('index'));
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
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(ChannelRequest $request): RedirectResponse
	{
		$store = $this->repository->setChannel($request);

		return $this->ifErrorAddUpdate($store, 'indexChannelAdmin', 'Ошибка сохранения');
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
		$edit = $this->repository->getChannel($url)->first();

		return view($this->backend . 'channel.edit', compact('edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\ChannelRequest  $request
	 * @param  string                             $url
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ChannelRequest $request, string $url): RedirectResponse
	{
		$update = $this->repository->setChannel($request, $url);

		return $this->ifErrorAddUpdate($update, 'indexChannelAdmin', 'Ошибка сохранения');
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
		$delete = $this->repository->deleteChannel($url);
		if ($delete) {
			return back();
		}
	}
}
