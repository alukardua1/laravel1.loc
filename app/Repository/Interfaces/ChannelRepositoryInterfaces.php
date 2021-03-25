<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface ChannelRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface ChannelRepositoryInterfaces
{
	/**
	 * @param  string  $channelUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $channelUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getChannel(): mixed;

	/**
	 * @param  string   $url
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setChannel(string $url, Request $request): mixed;
}