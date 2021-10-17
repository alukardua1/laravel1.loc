<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class ChannelController
 *
 * @package App\Http\Controllers
 */
class ChannelController extends Controller
{
	private ChannelRepositoryInterfaces $channelRepository;

	/**
	 * @param  \App\Repository\Interfaces\ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		parent::__construct();
		$this->channelRepository = $channelRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $channelUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
	public function index(string $channelUrl): View|Factory|Application
	{
		$showChannel = $this->channelRepository->getChannel($channelUrl)->first();
		$this->isNotNull($showChannel);
		$title = $showChannel->title;
		$description = $showChannel->description;
		$allAnime = $showChannel->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('showChannel', 'allAnime', 'title', 'description'));
	}
}
