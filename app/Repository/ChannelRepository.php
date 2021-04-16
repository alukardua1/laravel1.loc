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
	 * Получает канал по названию
	 *
	 * @param  string  $channelUrl урл канала
	 *
	 * @return mixed
	 */
	public function getAnime(string $channelUrl): mixed
	{
		return Channel::where('url', $channelUrl)
			->first();
	}

	/**
	 * Получает все каналы
	 *
	 * @return mixed
	 */
	public function getChannel(): mixed
	{
		return Channel::get();
	}

	/**
	 * Добавление/обновление канала
	 *
	 * @param  string   $channelUrl урл канала
	 * @param  Request  $request Запрос
	 *
	 * @return mixed
	 */
	public function setChannel(string $channelUrl, Request $request): mixed
	{
		// TODO: Implement setChannel() method.
	}
}