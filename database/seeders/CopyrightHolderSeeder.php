<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopyrightHolderSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			'copyright_holder' => 'Wakanim',
		];

		DB::table('copyright_holders')->insert($data);
	}
}
