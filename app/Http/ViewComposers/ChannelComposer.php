<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\View\View;

class ChannelComposer
{
	protected mixed                       $channel;
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
	public function channel(): mixed
	{
		return $this->channelRepository->getChannel()->get();
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