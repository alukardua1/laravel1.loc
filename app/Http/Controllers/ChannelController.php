<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;
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
	 * @return mixed
	 */
    public function index(string $channelUrl)
    {
	    $showChannel = $this->channelRepository->getAnime($channelUrl);
	    $this->isNotNull($showChannel);
	    $title = $showChannel->name;
	    $description = $showChannel->description;
	    $allAnime = $showChannel->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showChannel', 'allAnime', 'title', 'description'));
    }
}
