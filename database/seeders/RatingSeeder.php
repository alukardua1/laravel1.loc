<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

/**
 * Class RatingSeeder
 *
 * @package Database\Seeders
 */
class RatingSeeder extends Seeder
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
				'name'        => 'нет',
				'url'         => Str::slug('нет'),
				'description' => 'не указан',
			],
			[
				'name'        => 'G',
				'url'         => Str::slug('G'),
				'description' => 'G - Нет возрастных ограничений',
			],
			[
				'name'        => 'PG',
				'url'         => Str::slug('PG'),
				'description' => 'PG - Рекомендуется присутствие родителей',
			],
			[
				'name'        => 'PG-13',
				'url'         => Str::slug('PG-13'),
				'description' => 'PG-13 - Детям до 13 лет просмотр не желателен',
			],
			[
				'name'        => 'R-17',
				'url'         => Str::slug('R-17'),
				'description' => 'R - Лицам до 17 лет обязательно присутствие взрослого',
			],
			[
				'name'        => 'R+',
				'url'         => Str::slug('R+'),
				'description' => 'R+ - Лицам до 17 лет просмотр запрещён',
			],
			[
				'name'        => 'Rx',
				'url'         => Str::slug('Rx'),
				'description' => 'Rx - Хентай',
			],
		];
		DB::table('m_p_a_a_ratings')->insert($data);
	}
}
