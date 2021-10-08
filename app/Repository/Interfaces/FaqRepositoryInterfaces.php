<?php

namespace App\Repository\Interfaces;

interface FaqRepositoryInterfaces
{
	public function getFaq($faqUrl = null);

	public function setFaq(\Request $request, $faqUrl);
}