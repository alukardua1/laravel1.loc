<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class CategorySeeder
 *
 * @package Database\Seeders
 */
class CategorySeeder extends Seeder
{
	protected DLEParseRepository $category;
	protected Carbon             $createdAt;

	/**
	 * CategorySeeder constructor.
	 *
	 * @param  \App\Repository\DLEParseRepository  $DLEParseRepository
	 */
	public function __construct(DLEParseRepository $DLEParseRepository)
	{
		$this->category = $DLEParseRepository;
		$this->createdAt = Carbon::now();
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$categorys = $this->category->parseCategory();
		foreach ($categorys as $cat) {
			$data = $cat;
		}

		DB::table('categories')->insert($categorys);
	}
}
