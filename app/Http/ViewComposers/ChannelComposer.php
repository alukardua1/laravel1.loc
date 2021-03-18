<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\View\View;

class ChannelComposer
{
	public                                $channel;
	protected ChannelRepositoryInterfaces $channelRepository;

	/**
	 * Create a menu composer.
	 *
	 * @param  ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		$this->channelRepository = $channelRepositoryInterfaces;
		$this->channel = $this->channel();
	}

	/**
	 * @return mixed
	 */
	public function channel()
	{
		return $this->channelRepository->getChannel();
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 *
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('channel', $this->channel);
	}
}