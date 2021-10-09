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
	 * Получает все каналы
	 *
	 * @param  string|null  $channelUrl
	 *
	 * @return mixed
	 */
	public function getChannel(string $channelUrl = null): mixed;

	/**
	 * Добавление/обновление канала
	 *
	 * @param  string   $channelUrl  урл канала
	 * @param  Request  $request     Запрос
	 *
	 * @return mixed
	 */
	public function setChannel(string $channelUrl, Request $request): mixed;

	/**
	 * @param  string  $channelUrl
	 *
	 * @return mixed
	 */
	public function deleteChannel(string $channelUrl): mixed;
}