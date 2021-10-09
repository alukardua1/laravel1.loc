<?php

namespace App\Repository;

use App\Models\Faq;

class FaqRepository implements Interfaces\FaqRepositoryInterfaces
{

	/**
	 * @param  string|null  $faqUrl
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getFaq(string $faqUrl = null, bool $isAdmin = false): mixed
	{
		if ($faqUrl) {
			return Faq::where('url', $faqUrl);
		} elseif ($isAdmin) {
			return Faq::orderBy('created_at', 'DESC')->select(['id', 'title', 'url']);
		} else {
			return Faq::where('public_at', 1)->orderBy('created_at', 'DESC')->select(['id', 'title', 'url']);
		}
	}

	/**
	 * @param  \Request  $request
	 * @param  string    $faqUrl
	 *
	 * @return mixed
	 */
	public function setFaq(\Request $request, string $faqUrl): mixed
	{
		$allRequest = $request->all();

		$faqUpdate = Faq::firstOrCreate(['url', $faqUrl], $allRequest);
		if ($faqUpdate) {
			return $faqUpdate->save();
		}
	}

	/**
	 * @param  string  $faqUrl
	 *
	 * @return mixed
	 */
	public function delFaq(string $faqUrl): mixed
	{
		// TODO: Implement delFaq() method.
	}
}