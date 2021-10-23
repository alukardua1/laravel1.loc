<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ChannelController extends Controller
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
	 * @param  string  $url
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function show(string $url): View|Factory|Application
	{
		$show = $this->repository->getChannel($url)->first();
		$views = $this->views($show);

		return view($this->frontend . 'anime.short', compact('views'));
	}
}
