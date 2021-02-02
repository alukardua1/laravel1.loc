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
          ['title' => 'Администратор'],
          ['title' => 'Модератор'],
          ['title' => 'Пользователь'],
        ];
        DB::table('groups')->insert($data);
    }
}
