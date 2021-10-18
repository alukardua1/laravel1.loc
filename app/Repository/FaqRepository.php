<?php

namespace App\Repository;

use App\Models\Faq;
use App\Repository\Interfaces\FaqRepositoryInterfaces;
use Illuminate\Http\Request;

class FaqRepository implements FaqRepositoryInterfaces
{

	/**
	 * @param  string|null  $url
	 * @param  bool         $isAdmin
	 *
	 * @return mixed
	 */
	public function getFaq(string $url = null, bool $isAdmin = false): mixed
	{
		if ($url) {
			return Faq::where('url', $url);
		} elseif ($isAdmin) {
			return Faq::orderBy('created_at', 'DESC')->select(['id', 'title', 'url']);
		} else {
			return Faq::where('public_at', 1)->orderBy('created_at', 'DESC')->select(['id', 'title', 'url']);
		}
	}

	/**
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string|null               $url
	 *
	 * @return mixed
	 */
	public function setFaq(Request $request, string $url = null): mixed
	{
		$allRequest = $request->all();

		$faqUpdate = Faq::firstOrCreate(['url', $url], $allRequest);
		if ($faqUpdate) {
			return $faqUpdate->save();
		}
	}

	/**
	 * @param  string  $url
	 * @param  bool    $fullDel
	 *
	 * @return mixed
	 */
	public function delFaq(string $url, bool $fullDel = false): mixed
	{
		// TODO: Implement delFaq() method.
	}
}