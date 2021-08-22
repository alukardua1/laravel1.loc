<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AnimeSeeder
 *
 * @package Database\Seeders
 */
class AnimeSeeder extends Seeder
{
	protected DLEParseRepository $anime;

	public function __construct(DLEParseRepository $DLEParseRepository)
	{
		$this->anime = $DLEParseRepository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$post = $this->anime->parsePost();
		foreach ($post as $value) {
			DB::table('animes')->insert($value);
		}
	}
}
