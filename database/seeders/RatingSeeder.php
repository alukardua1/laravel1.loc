<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
				'title'        => 'нет',
				'url'         => 'none',
				'description' => 'не указан',
			],
			[
				'title'        => 'G',
				'url'         => 'g',
				'description' => 'G - Нет возрастных ограничений',
			],
			[
				'title'        => 'PG',
				'url'         => 'pg',
				'description' => 'PG - Рекомендуется присутствие родителей',
			],
			[
				'title'        => 'PG-13',
				'url'         => 'pg_13',
				'description' => 'PG-13 - Детям до 13 лет просмотр не желателен',
			],
			[
				'title'        => 'R-17',
				'url'         => 'r',
				'description' => 'R - Лицам до 17 лет обязательно присутствие взрослого',
			],
			[
				'title'        => 'R+',
				'url'         => 'r_plus',
				'description' => 'R+ - Лицам до 17 лет просмотр запрещён',
			],
			[
				'title'        => 'Rx',
				'url'         => 'rx',
				'description' => 'Rx - Хентай',
			],
		];
		DB::table('m_p_a_a_ratings')->insert($data);
	}
}
