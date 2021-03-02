<?php

namespace Database\Seeders;

use App\Repository\Interfaces\DLEParse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AnimeCategorySeeder
 *
 * @package Database\Seeders
 */
class AnimeCategorySeeder extends Seeder
{
    protected $animeCategory;

	/**
	 * AnimeCategorySeeder constructor.
	 *
	 * @param  \App\Repository\Interfaces\DLEParse  $DLEParse
	 */
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
