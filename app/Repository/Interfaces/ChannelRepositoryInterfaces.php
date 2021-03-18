<?php


namespace App\Repository\Interfaces;


/**
 * Interface ChannelRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface ChannelRepositoryInterfaces
{
	/**
	 * @param string $channelUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $channelUrl);

	/**
	 * @return mixed
	 */
	public function getChannel();
}