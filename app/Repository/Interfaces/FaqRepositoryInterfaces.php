<?php

namespace App\Repository\Interfaces;

interface FaqRepositoryInterfaces
{
	/**
	 * @param  string|null  $faqUrl
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getFaq(string $faqUrl = null, bool $isAdmin = false): mixed;

	/**
	 * @param  \Request  $request
	 * @param  string    $faqUrl
	 *
	 * @return mixed
	 */
	public function setFaq(\Request $request, string $faqUrl): mixed;

	/**
	 * @param  string  $faqUrl
	 *
	 * @return mixed
	 */
	public function delFaq(string $faqUrl): mixed;
}