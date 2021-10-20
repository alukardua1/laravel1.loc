<?php


namespace App\Repository;


use App\Http\Requests\ChannelRequest;
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
	 * Получает все каналы
	 *
	 * @param  string|null  $url
	 *
	 * @return mixed
	 */
	public function getChannel(string $url = null): mixed
	{
		if ($url) {
			return Channel::where('url', $url);
		}
		return Channel::orderBy('title', 'ASC');
	}

	/**
	 * Добавление/обновление канала
	 *
	 * @param  \App\Http\Requests\ChannelRequest  $request  Запрос
	 * @param  string|null                        $url
	 *
	 * @return mixed
	 */
	public function setChannel(ChannelRequest $request, string $url = null): mixed
	{
		// TODO: Implement setChannel() method.
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteChannel(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delete() method.
	}
}