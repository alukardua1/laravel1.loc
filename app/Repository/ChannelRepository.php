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
	 * @param  string  $channelUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $channelUrl)
	{
		return Channel::where('url', $channelUrl)
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