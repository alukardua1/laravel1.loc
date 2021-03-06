<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UsersSeeder
 *
 * @package Database\Seeders
 */
class UsersSeeder extends Seeder
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
				'login'             => 'admin',
				'name'              => 'Alukard Nosferatu',
				'group_id'          => '1',
				'country_id'        => 1,
				'email'             => 'prizrack30@gmail.com',
				'email_verified_at' => now(),
				'password'          => Hash::make('12345678'),
				'remember_token'    => Str::random(10),
			],
		];

		DB::table('users')->insert($data);
	}
}
