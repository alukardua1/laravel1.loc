<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

/**
 * Class CountrySeeder
 *
 * @package Database\Seeders
 */
class CountrySeeder extends Seeder
{
	protected DLEParseRepository $kodikRepository;

	/**
	 * CountrySeeder constructor.
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
		$country = $this->kodikRepository->parseKodik('https://kodikapi.com/countries?token=16b2ff25feb8e53b0aded1ebb0fff2c1');
		foreach ($country as $value) {
			$data[] = [
				'name' => $value,
				'url'  => Str::slug($value),
			];
		}

		DB::table('countries')->insert($data);
	}
}
