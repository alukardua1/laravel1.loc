<?php

namespace App\Services;

trait CurlTrait
{
	private string $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30';
	public mixed   $result;

	/**
	 * @param  string  $url
	 *
	 * @return mixed
	 */
	public function getCurl(string $url): mixed
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FAILONERROR, 1);
		curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
		$this->result = curl_exec($curl);
		curl_close($curl);
		$this->result = json_decode($this->result, true);

		return $this->result;
	}
}
