<?php


namespace App\Services;


trait ParseShikimori
{
	use CurlTrait;

	protected $shikimoriData;
	protected $shikimoriID;
	protected $shikimoriApiUrl = 'https://shikimori.one/api/animes/';
	protected $shikimoriOtherMethod = ['roles', 'similar', 'related', 'franchise', 'external_links'];

	public function getShikimori($link)
	{
		$this->shikimoriID = $this->getId($link);
		$this->shikimoriApiUrl = $this->shikimoriApiUrl . $this->shikimoriID;
		$this->shikimoriData = $this->getCurl($this->shikimoriApiUrl);

		return $this->shikimoriData;
	}

	public function getId($link)
	{
		$linkArr = explode('/', $link);

		return end($linkArr);
	}
}