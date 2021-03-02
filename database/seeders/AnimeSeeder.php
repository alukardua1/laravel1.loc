<?php

namespace Database\Seeders;

use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimeSeeder extends Seeder
{
	protected $anime;

	public function __construct(DLEParse $DLEParse)
	{
		$this->anime = $DLEParse;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$post = $this->anime->parsePost();
		foreach ($post as $value)
		{
			DB::table('animes')->insert($value);
		}
	}
}
