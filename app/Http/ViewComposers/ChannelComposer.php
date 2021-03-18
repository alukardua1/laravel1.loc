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
	 * @param  \App\Repository\Interfaces\ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		$this->channelRepository = $channelRepositoryInterfaces;
		$this->channel = $this->menu();
	}

	/**
	 * @return mixed
	 */
	public function menu()
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