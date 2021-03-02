<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class TranslateSeeder
 *
 * @package Database\Seeders
 */
class TranslateSeeder extends Seeder
{
	protected $kodikRepository;

	/**
	 * TranslateSeeder constructor.
	 *
	 * @param  \App\Repository\DLEParseRepository  $DLEParseRepository
	 */
	public function __construct(DLEParseRepository $DLEParseRepository)
	{
		$this->kodikRepository = $DLEParseRepository;
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $translate = $this->kodikRepository->parseKodik('https://kodikapi.com/translations/v2?token=16b2ff25feb8e53b0aded1ebb0fff2c1');

       foreach ($translate as $value)
       {
	       $data[] = [
		       'name' => $value,
		       'url'  => \Str::slug($value),
	       ];
       }

	    DB::table('translates')->insert($data);
    }
}
