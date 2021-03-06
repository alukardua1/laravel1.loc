<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\DLEParse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParseDbDLEController extends Controller
{
	private DLEParse $dleParseRepository;

	public function __construct(DLEParse $DLEParse)
	{
		$this->dleParseRepository = $DLEParse;
	}

	public function index($id = null)
	{
		$category = $this->dleParseRepository->parseCategory();
		$user = $this->dleParseRepository->parseUser();
		$post = $this->dleParseRepository->parsePost($id);
		$animeCategory = $this->dleParseRepository->parsePostCategory();
		$studios = $this->dleParseRepository->parseStudio();
		$channel = $this->dleParseRepository->parseChannel();
		$country = $this->dleParseRepository->parseKodik('https://kodikapi.com/countries?token=16b2ff25feb8e53b0aded1ebb0fff2c1');
		foreach ($country as $value) {
			$data[] = [
				'name' => $value,
				'url'  => \Str::slug($value),
			];
		}
		/*foreach ($category as $cat)
		{
			DB::table('categories')->insert($cat);
		}
		foreach ($post as $value)
		{
			DB::table('animes')->insert($value);
		}
		foreach ($animeCategory as $value)
		{
			DB::table('anime_category')->insert($value);
		}*/

		dd(__METHOD__, $post, 111);
	}
}
