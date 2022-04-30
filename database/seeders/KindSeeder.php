<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

/**
 * Class KindSeeder
 *
 * @package Database\Seeders
 */
class KindSeeder extends Seeder
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
                'title'       => 'OVA',
                'url'        => 'ova',
                'full_name'  => 'Original Video Animation',
                'short_name' => 'ОВА'
            ],
            [
                'title'       => 'Movie',
                'url'        => 'movie',
                'full_name'  => 'Полнометражный фильм',
                'short_name' => 'Фильм'
            ],
            [
                'title'       => 'TV',
                'url'        => 'tv',
                'full_name'  => 'Телевизионная версия',
                'short_name' => 'ТВ'
            ],
            [
                'title'       => 'ONA',
                'url'        => 'ona',
                'full_name'  => 'Original net animation',
                'short_name' => 'Веб'
            ],
            [
                'title'       => 'Music',
                'url'        => 'music',
                'full_name'  => 'Музыкальное видео',
                'short_name' => 'Клип'
            ],
            [
                'title'       => 'Special',
                'url'        => 'special',
                'full_name'  => 'Специальные выпускы',
                'short_name' => 'Спешл'
            ]
        ];

        DB::table('kinds')->insert($data);
    }
}
