<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
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
				'title'        => 'Администратор',
				'color'        => 'red',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Модератор',
				'color'        => 'green',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Пользователь',
				'color'        => '#000000',
				'is_dashboard' => 0,
			],
		];
		DB::table('groups')->insert($data);
	}
}
