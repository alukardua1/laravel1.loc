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
				'color'        => '#ff0000',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Журналист',
				'color'        => '#00ff00',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Модератор',
				'color'        => '#0000ff',
				'is_dashboard' => 1,
			],
			[
				'title'        => 'Пользователь',
				'color'        => '#707070',
				'is_dashboard' => 0,
			],
		];
		DB::table('groups')->insert($data);
	}
}
