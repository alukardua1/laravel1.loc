<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			[
				'name'       => 'Россия',
				'url'       => \Str::slug('Россия'),
			],
		];

		DB::table('countries')->insert($data);
	}
}
