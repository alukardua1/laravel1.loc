<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AnimeCategorySeeder
 *
 * @package Database\Seeders
 */
class AnimeCategorySeeder extends Seeder
{
	protected DLEParseRepository $animeCategory;

	/**
	 * AnimeCategorySeeder constructor.
	 *
	 * @param  \App\Repository\DLEParseRepository  $DLEParseRepository
	 */
	public function __construct(DLEParseRepository $DLEParseRepository)
	{
		$this->animeCategory = $DLEParseRepository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$post = $this->animeCategory->parsePostCategory();

		foreach ($post as $value) {
			DB::table('anime_category')->insert($value);
		}
	}
}
