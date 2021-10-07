<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class GroupSeeder
 *
 * @package Database\Seeders
 */
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
				'title'        => 'Журналист',
				'color'        => 'green',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Модератор',
				'color'        => 'blue',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Пользователь',
				'color'        => 'grey',
				'is_dashboard' => 0,
			],
		];
		DB::table('groups')->insert($data);
	}
}
