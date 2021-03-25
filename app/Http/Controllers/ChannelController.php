<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class ChannelController
 *
 * @package App\Http\Controllers
 */
class ChannelController extends Controller
{
	private ChannelRepositoryInterfaces $channelRepository;

	/**
	 * ChannelController constructor.
	 *
	 * @param  ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		parent::__construct();
		$this->channelRepository = $channelRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param string $channelUrl
	 *
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
	 */
    public function index(string $channelUrl): View|Factory|Application
    {
	    $showChannel = $this->channelRepository->getAnime($channelUrl);
	    $this->isNotNull($showChannel);
	    $title = $showChannel->name;
	    $description = $showChannel->description;
	    $allAnime = $showChannel->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showChannel', 'allAnime', 'title', 'description'));
    }
}
