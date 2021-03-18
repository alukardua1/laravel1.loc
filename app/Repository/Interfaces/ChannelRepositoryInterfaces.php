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
	 * @param $kind
	 *
	 * @return mixed
	 */
	public function getAnime($kind);

	/**
	 * @return mixed
	 */
	public function getChannel();
}