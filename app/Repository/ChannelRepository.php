<?php


namespace App\Repository;


use App\Models\Channel;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Http\Request;

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
	public function getAnime(string $channelUrl): mixed
	{
		return Channel::where('url', $channelUrl)
			->first();
	}

	/**
	 * @return mixed
	 */
	public function getChannel(): mixed
	{
		return Channel::get();
	}

	/**
	 * @param  string   $url
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setChannel(string $url, Request $request): mixed
	{
		// TODO: Implement setChannel() method.
	}
}