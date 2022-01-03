<?php


namespace App\Http\ViewComposers;


use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\View\View;

class ChannelComposer extends ComposersAbstract
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
	protected function view(): mixed
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