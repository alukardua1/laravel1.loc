<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();

		$this->call(CountrySeeder::class);
		$this->call(GroupSeeder::class);
		$this->call(UsersSeeder::class);
		\App\Models\User::factory(10)->create();
		$this->call(KindSeeder::class);
		$this->call(CategorySeeder::class);
		$this->call(RatingSeeder::class);
		$this->call(ChannelSeeder::class);
		$this->call(StudiosSeeder::class);
		$this->call(QualitySeeder::class);
		$this->call(TranslateSeeder::class);
		$this->call(CopyrightHolderSeeder::class);
		$this->call(GeoBlockSeeder::class);
		//$this->call(AnimeSeeder::class);
		//$this->call(AnimeCategorySeeder::class);
	}
}
