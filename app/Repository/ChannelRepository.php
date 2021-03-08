<?php


namespace App\Repository;


use App\Models\Channel;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;

/**
 * Class ChannelRepository
 *
 * @package App\Repository
 */
class ChannelRepository implements ChannelRepositoryInterfaces
{

	/**
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind)
	{
		return Channel::where('url', $kind)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getChannel()
	{
		return Channel::get();
	}
}