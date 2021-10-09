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
	 * Получает все каналы
	 *
	 * @param  string|null  $channelUrl
	 *
	 * @return mixed
	 */
	public function getChannel(string $channelUrl = null): mixed
	{
		if ($channelUrl) {
			return Channel::where('url', $channelUrl);
		}
		return Channel::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление канала
	 *
	 * @param  string   $channelUrl  урл канала
	 * @param  Request  $request     Запрос
	 *
	 * @return mixed
	 */
	public function setChannel(string $channelUrl, Request $request): mixed
	{
		// TODO: Implement setChannel() method.
	}

	/**
	 * @param  string  $channelUrl
	 *
	 * @return mixed
	 */
	public function deleteChannel(string $channelUrl): mixed
	{
		// TODO: Implement delete() method.
	}
}