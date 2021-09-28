<?php

namespace App\Repository;

use App\Models\Banner;
use App\Repository\Interfaces\BannerRepositoryInterfaces;
use Illuminate\Http\Request;

class BannerRepository implements BannerRepositoryInterfaces
{

	public function getBanner($banner)
	{
		return Banner::where('name', $banner);
	}

	public function setBanner(Request $request, $nameBanner = null)
	{
		// TODO: Implement setBanner() method.
	}
}