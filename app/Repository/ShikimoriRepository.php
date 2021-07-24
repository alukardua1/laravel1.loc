<?php


namespace App\Repository;


use App\Repository\Interfaces\ShikimoriInterfacesRepository;

/**
 * Class ShikimoriRepository
 *
 * @package App\Repository
 * @todo решить нужен ли
 */
class ShikimoriRepository implements ShikimoriInterfacesRepository
{

	/**
	 * @var string|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
	 */
	private string $shikimoriApiUrl;

	/**
	 * ShikimoriRepository constructor.
	 */
	public function __construct()
	{
		$this->shikimoriApiUrl = config('shikimoriConfig.shikiApiUrl');
	}

	/**
	 * @param  string  $id
	 *
	 * @return mixed|void
	 */
	public function getShikimori(string $id)
	{
		// TODO: Implement getShikimori() method.
	}
}