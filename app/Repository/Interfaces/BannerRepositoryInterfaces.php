<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface BannerRepositoryInterfaces
{
	public function getBanner($banner);

	public function setBanner(Request $request, $nameBanner = null);
}