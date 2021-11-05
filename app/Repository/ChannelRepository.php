<?php


namespace App\Repository;


use App\Http\Requests\ChannelRequest;
use App\Models\Channel;
use App\Repository\Interfaces\ChannelRepositoryInterfaces;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChannelRepository
 *
 * @package App\Repository
 */
class ChannelRepository implements ChannelRepositoryInterfaces
{

	private Model $model;

	public function __construct(Channel $channel)
	{
		$this->model = $channel;
	}

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
			return $this->model->where('url', $url);
		}
		return $this->model->orderBy('title', 'ASC');
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
		$formRequest = $request->all();
		$update = $this->model->updateOrCreate(['url' => $url], $formRequest);
		if ($update) {
			return $update->save();
		}
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function deleteChannel(string $url, bool $fullDel = false): mixed
	{
		$delete = $this->model->findOrFail($url, ['*']);
		if ($delete) {
			if ($fullDel) {
				return $delete->forceDelete();
			}
			return $delete->delete();
		}
	}
}