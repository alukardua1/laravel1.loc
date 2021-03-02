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
	private $channel;

	/**
	 * ChannelController constructor.
	 *
	 * @param  \App\Repository\Interfaces\ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		parent::__construct();
		$this->channel = $channelRepositoryInterfaces;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $channel
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function index($channel)
    {
	    $showChannel = $this->channel->getAnime($channel);
	    $this->isNotNull($showChannel);
	    $title = $showChannel->name;
	    $description = $showChannel->description;
	    $allAnime = $showChannel->getAnime()->paginate($this->paginate);

	    return view($this->frontend . 'anime.short', compact('showChannel', 'allAnime', 'title', 'description'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Channel  $channel
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function show(Channel $channel)
    {
	    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
