<?php


namespace App\Services;


/**
 * Trait ParseShikimori
 *
 * @package App\Services
 */
trait ParseShikimori
{
	use CurlTrait;

	protected mixed  $shikimoriData;
	protected string $shikimoriID;
	protected string $shikimoriApiUrl      = 'https://shikimori.one/api/animes/';
	protected array  $shikimoriOtherMethod = ['roles', 'similar', 'related', 'franchise', 'external_links'];

	/**
	 * Получает данные с шикимори
	 *
	 * @param $link
	 *
	 * @return mixed
	 */
	public function getShikimori($link)
	{
		$this->shikimoriID = $this->getId($link);
		$this->shikimoriApiUrl = $this->shikimoriApiUrl . $this->shikimoriID;
		$this->shikimoriData = $this->getCurl($this->shikimoriApiUrl);

		return $this->shikimoriData;
	}

	/**
	 * Получает ID записи из ссылки на шикимори
	 *
	 * @param $link
	 *
	 * @return mixed
	 */
	public function getId($link)
	{
		$linkArr = explode('/', $link);

		return end($linkArr);
	}
}