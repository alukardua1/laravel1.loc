<?php

namespace App\Repository;

use App\Models\Faq;

class FaqRepository implements Interfaces\FaqRepositoryInterfaces
{

	public function getFaq($faqUrl = null)
	{
		if ($faqUrl) {
			return Faq::where('url', $faqUrl);
		} else {
			return Faq::orderBy('created_at', 'DESC')->select(['id', 'title', 'url']);
		}
	}

	public function setFaq(\Request $request, $faqUrl)
	{
		$allRequest = $request->all();

		$faqUpdate = Faq::firstOrCreate(['url', $faqUrl], $allRequest);
		if ($faqUpdate) {
			return $faqUpdate->save();
		}
	}
}