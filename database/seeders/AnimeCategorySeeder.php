<?php

namespace Database\Seeders;

use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimeCategorySeeder extends Seeder
{
    protected $animeCategory;

    public function __construct(DLEParse $DLEParse)
    {
        $this->animeCategory = $DLEParse;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = $this->animeCategory->parsePostCategory();

        foreach ($post as $value)
        {
            DB::table('anime_category')->insert($value);
        }
    }
}
