<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

        $this->call(UsersSeeder::class);
        $this->call(KindSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AnimeSeeder::class);
        $this->call(AnimeCategorySeeder::class);
        $this->call(StudiosSeeder::class);
        $this->call(QualitySeeder::class);
    }
}
