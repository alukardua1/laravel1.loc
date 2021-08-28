<?php


namespace App\Repository;


use App\Repository\Interfaces\ShikimoriInterfacesRepository;
use App\Services\CurlTrait;

/**
 * Class ShikimoriRepository
 *
 * @todo    решить нужен ли
 * @package App\Repository
 */
class ShikimoriRepository implements ShikimoriInterfacesRepository
{
	use CurlTrait;

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
		$shikiData = $this->getCurl($id);
		// TODO: Implement getShikimori() method.
	}
}