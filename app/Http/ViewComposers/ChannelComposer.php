<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\View\View;

class ChannelComposer
{
	private ChannelRepositoryInterfaces $repository;

	/**
	 * @param  \App\Repository\Interfaces\ChannelRepositoryInterfaces  $channelRepositoryInterfaces
	 */
	public function __construct(ChannelRepositoryInterfaces $channelRepositoryInterfaces)
	{
		$this->repository = $channelRepositoryInterfaces;
	}

	/**
	 * @return mixed
	 */
	public function view(): mixed
	{
		return $this->repository->getChannel()->get();
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
		$view->with('channel', $this->view());
	}
}